<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\Requests\ExpenseRequest;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $expenses = Expense::where('userID', auth()->id())
                            ->with('user')
                            ->paginate(10); // Pagination added

        return view('dashboard.expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('dashboard.expenses.create');
    }

    public function store(ExpenseRequest $request)
    {
        Expense::create([
            'userID' => auth()->id(),
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully.');
    }

    public function edit(Expense $expense)
    {
        $this->authorizeExpense($expense);

        return view('dashboard.expenses.edit', compact('expense'));
    }

    public function update(ExpenseRequest $request, Expense $expense)
    {
        $this->authorizeExpense($expense);

        $expense->update($request->all());

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $this->authorizeExpense($expense);

        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }

    public function show(Expense $expense)
    {
        $this->authorizeExpense($expense);

        return view('dashboard.expenses.show', compact('expense'));
    }

    private function authorizeExpense(Expense $expense)
    {
        if ($expense->userID !== auth()->id()) {
            return redirect()->route('expenses.index')->withErrors('You are not authorized to access this expense.');
        }
    }
}
