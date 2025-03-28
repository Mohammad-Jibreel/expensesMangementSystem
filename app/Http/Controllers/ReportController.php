<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Expense;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $fromMonth   = $request->input('from_month', Carbon::now()->month);
        $fromYear    = $request->input('from_year', Carbon::now()->year);
        $toMonth     = $request->input('to_month', Carbon::now()->subMonth()->month);
        $toYear      = $request->input('to_year', Carbon::now()->year);
        $category_id = $request->input('category_id', null);
        $currentMonthExpenses = Expense::where('user_id', $userId)
        ->when($category_id, function ($query, $category_id) {
            return $query->where('category_id', $category_id);
        })
        ->whereMonth('created_at', $fromMonth)  // Make sure the `fromMonth` variable is used here
        ->whereYear('created_at', $fromYear)    // Same for `fromYear`
        ->groupBy('category_id')  // Group by category_id
        ->selectRaw('category_id, SUM(amount) as total')  // Select the category and sum the amounts
        ->get();

        $previousMonthExpenses = Expense::where('user_id', $userId)
            ->when($category_id, function ($query, $category_id) {
                return $query->where('category_id', $category_id);
            })
            ->whereMonth('created_at', $toMonth)
            ->whereYear('created_at', $toYear)
            ->groupBy('category_id')
            ->selectRaw('category_id, SUM(amount) as total')
            ->with('category')
            ->get();
            $topExpenses = Expense::where('user_id', $userId)
            ->with('category')
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->orderBy('amount', 'desc')
            ->take(5)
            ->get();





        return view('dashboard.reports.index', compact(
            'currentMonthExpenses',
            'previousMonthExpenses',
            'topExpenses',
            'fromMonth',
            'fromYear',
            'toMonth',
            'toYear',
            'category_id'
        ));
    }

    public function create()
    {
        return view('dashboard.Reports.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'totalExpenses' => 'required|numeric',
            'totalIncome' => 'required|numeric',
            'netBalance' => 'required|numeric',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
        ]);
        $validated['userID'] = auth()->id();
        Report::create($validated);
        return redirect()->route('report.index')->with('success', 'Report created successfully.');
    }


    public function show(Report $report)
    {
        $this->authorize('view', $report);
        return view('dashboard.Reports.show', compact('report'));
    }


    public function edit(Report $report)
    {
        $this->authorize('update', $report);
        return view('dashboard.Reports.edit', compact('report'));
    }


    public function update(Request $request, Report $report)
    {
        $this->authorize('update', $report);
        $validated = $request->validate([
            'totalExpenses' => 'required|numeric',
            'totalIncome' => 'required|numeric',
            'netBalance' => 'required|numeric',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
        ]);
        $report->update($validated);
        return redirect()->route('report.index')->with('success', 'Report updated successfully.');
    }

    public function destroy(Report $report)
    {
        $this->authorize('delete', $report);
        $report->delete();
        return redirect()->route('report.index')->with('success', 'Report deleted successfully.');
    }

    public function export($id, $format)
    {
        $report = Report::findOrFail($id);

        if ($format == 'csv') {
            return $this->exportCSV([$report], 'report_' . $report->reportID . '.csv');
        } elseif ($format == 'pdf') {
            return $this->exportPDF([$report], 'report_' . $report->reportID . '.pdf');
        }

        return back()->with('error', 'Invalid export format.');
    }

    public function exportAll($format)
    {
        $reports = Report::all();

        if ($format == 'csv') {
            return $this->exportCSV($reports, 'all_reports.csv');
        } elseif ($format == 'pdf') {
            return $this->exportPDF($reports, 'all_reports.pdf');
        }

        return back()->with('error', 'Invalid export format.');
    }

    private function exportCSV($reports, $fileName)
    {
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ];

        $csvContent = fopen('php://output', 'w');
        fputcsv($csvContent, ['Report ID', 'User ID', 'Total Expenses', 'Total Income', 'Net Balance', 'Start Date', 'End Date']);

        foreach ($reports as $report) {
            fputcsv($csvContent, [
                $report->reportID,
                $report->userID,
                $report->totalExpenses,
                $report->totalIncome,
                $report->netBalance,
                $report->startDate,
                $report->endDate,
            ]);
        }

        fclose($csvContent);

        return Response::stream(function () use ($csvContent) {
            fpassthru($csvContent);
        }, 200, $headers);
    }

    private function exportPDF($reports, $fileName)
    {
        $pdf = Pdf::loadView('dashboard.Reports.pdf', compact('reports'));
        return $pdf->download($fileName);
    }
}
