<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BudgetRequest;

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
        $budgets = Budget::where('userID', auth()->id())
                        ->paginate(10); // Pagination added

        return view('dashboard.budgets.index', compact('budgets'));
    }

    public function create()
    {
        return view('dashboard.budgets.create');
    }

    public function store(BudgetRequest $request)
    {
        Budget::create([
            'userID' => auth()->id(),
            'limit' => $request->limit,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
        ]);

        return redirect()->route('budgets.index')->with('success', 'Budget added successfully.');
    }

    public function edit(Budget $budget)
    {
        $this->authorizeBudget($budget);

        return view('dashboard.budgets.edit', compact('budget'));
    }

    public function update(BudgetRequest $request, Budget $budget)
    {
        $this->authorizeBudget($budget);

        $budget->update($request->all());

        return redirect()->route('budgets.index')->with('success', 'Budget updated successfully.');
    }

    public function destroy(Budget $budget)
    {
        $this->authorizeBudget($budget);

        $budget->delete();

        return redirect()->route('budgets.index')->with('success', 'Budget deleted successfully.');
    }

    public function show(Budget $budget)
    {
        $this->authorizeBudget($budget);

        return view('dashboard.budgets.show', compact('budget'));
    }

    private function authorizeBudget(Budget $budget)
    {
        if ($budget->userID !== auth()->id()) {
            return redirect()->route('budgets.index')->withErrors('You are not authorized to access this budget.');
        }
    }
}
