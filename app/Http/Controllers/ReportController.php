<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;  // ✅ Fix for Response
use Barryvdh\DomPDF\Facade\Pdf;           // ✅ Fix for Pdf

class ReportController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get reports for the authenticated user, paginate the results
        $reports = Report::where('userID', auth()->id())->paginate(10);
        return view('dashboard.Reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.Reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'totalExpenses' => 'required|numeric',
            'totalIncome' => 'required|numeric',
            'netBalance' => 'required|numeric',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
        ]);

        // Create the report
        $validated['userID'] = auth()->id(); // Associate the user
        Report::create($validated);

        // Redirect to reports index with a success message
        return redirect()->route('report.index')->with('success', 'Report created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        // Ensure the report belongs to the logged-in user
        $this->authorize('view', $report);
        return view('dashboard.Reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        // Ensure the report belongs to the logged-in user
        $this->authorize('update', $report);
        return view('dashboard.Reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        // Ensure the report belongs to the logged-in user
        $this->authorize('update', $report);

        // Validate the input data
        $validated = $request->validate([
            'totalExpenses' => 'required|numeric',
            'totalIncome' => 'required|numeric',
            'netBalance' => 'required|numeric',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
        ]);

        // Update the report
        $report->update($validated);

        // Redirect to reports index with a success message
        return redirect()->route('report.index')->with('success', 'Report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        // Ensure the report belongs to the logged-in user
        $this->authorize('delete', $report);

        // Delete the report
        $report->delete();

        // Redirect to reports index with a success message
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
