<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BudgetRequest;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $budgets = Budget::where('user_id', Auth::id())->orderByDesc('year')->orderByDesc('month')->get();
        return view('dashboard.budgets.index', compact('budgets'));
    }

    public function create()
    {
        return view('dashboard.budgets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'salary' => 'required|numeric|min:0',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
            'month' => 'required|integer|min:1|max:12',
        ]);

        // Ensure a budget does not already exist for the same month & year
        $exists = Budget::where('user_id', Auth::id())
            ->where('year', $request->year)
            ->where('month', $request->month)
            ->exists();

        if ($exists) {
            return back()->withErrors(['month' => 'A budget for this month and year already exists.']);
        }

        Budget::create([
            'user_id' => Auth::id(),
            'salary' => $request->salary,
            'year' => $request->year,
            'month' => $request->month,
            'total_expenses' => 0,
            'remaining_balance' => $request->salary, // Initially, remaining balance = salary
        ]);

        return redirect()->route('budgets.index')->with('success', 'Budget created successfully.');
    }

    public function edit(Budget $budget)
    {
        if ($budget->user_id !== Auth::id()) {
            abort(403);
        }
        return view('dashboard.budgets.edit', compact('budget'));
    }

    public function update(Request $request, Budget $budget)
    {
        if ($budget->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'salary' => 'required|numeric|min:0',
        ]);

        $budget->update([
            'salary' => $request->salary,
            'remaining_balance' => $request->salary - $budget->total_expenses,
            'year'=>$request->year,
            'month'=>$request->month

        ]);

        return redirect()->route('budgets.index')->with('success', 'Budget updated successfully.');
    }

    public function destroy(Budget $budget)
    {
        if ($budget->user_id !== Auth::id()) {
            abort(403);
        }
        $budget->delete();
        return redirect()->route('budgets.index')->with('success', 'Budget deleted successfully.');
    }
}
