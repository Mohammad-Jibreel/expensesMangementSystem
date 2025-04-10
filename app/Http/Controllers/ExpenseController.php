<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use App\Models\Budget;

use App\Http\Requests\ExpenseRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExpenseController extends Controller
{


    public function index()
    {
        $expenses = Expense::where('user_id', auth()->id())
        ->with('category')
        ->paginate(10);
        return view('dashboard.expenses.index', compact('expenses'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.expenses.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $carbonDate = Carbon::parse($request->date ?: now());

        // Extract the year and month from the date
        $year = $carbonDate->year;
        $month = $carbonDate->month;

        // Find the user's budget for the specific month and year
        $budget = Budget::where('user_id', auth()->id())
                        ->where('year', $year)
                        ->where('month', $month)->first();

        // If no budget is found, return an error
        if (!$budget) {
            return redirect()->back()->withErrors(['amount' => 'There is no budget for the selected month!']);
        }

        // If the salary is not set for the selected month, return an error
        if ($budget->salary == 0) {
            return redirect()->back()->withErrors(['amount' => 'Salary for the selected month has not been set!']);
        }

        // Validate the expense amount
        if ($request->amount <= 0) {
            return redirect()->back()->withErrors(['amount' => 'Expense amount must be greater than zero!']);
        }

        // Check if the expense exceeds the available balance in the budget
        if (($budget->total_expenses + $request->amount) > $budget->salary) {
            return redirect()->back()->withErrors(['amount' => 'Expense exceeds available balance for this month!']);
        }

        // Add the expense to the expense table
        $expense = Expense::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'date' => $carbonDate->toDateString(),  // Convert date to 'Y-m-d'
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        // Update the total expenses in the budget table
        $budget->total_expenses += $expense->amount;

        // Update the remaining balance in the budget
        $budget->remaining_balance = $budget->salary - $budget->total_expenses;

        // Update the budget (not create)
        $budget->update();

        // Redirect with success message
        return redirect()->route('expenses.index')->with('success', 'Expense added and budget updated!');
    }





    public function edit(Expense $expense)
    {

        $categories = Category::all(); // Fetch categories for dropdown
        return view('dashboard.expenses.edit', compact('expense', 'categories'));
    }

    public function update(ExpenseRequest $request, Expense $expense)
    {
        $this->authorizeExpense($expense);

        $oldAmount = $expense->amount;

        // Parse the date from the request
        $carbonDate = Carbon::parse($request->date);

        // Find the related budget for the selected month and year
        $budget = Budget::where('user_id', auth()->id())
                        ->where('year', $carbonDate->year)
                        ->where('month', $carbonDate->month)
                        ->first();

        // If no budget exists for the selected month, return an error
        if (!$budget) {
            return redirect()->back()->withErrors(['amount' => 'There is no budget for the selected month and year!']);
        }

        // Update the expense
        $expense->update([
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        // Recalculate the total expenses for the budget
        $budget->total_expenses = $budget->total_expenses - $oldAmount + $request->amount;

        // Update the remaining balance in the budget
        $budget->remaining_balance = $budget->salary - $budget->total_expenses;

        // Save the updated budget
        $budget->save();

        // Redirect with success message
        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }



    public function destroy(Expense $expense)
{
    $this->authorizeExpense($expense);
    $carbonDate = Carbon::parse($expense->date);
    $budget = Budget::where('user_id', auth()->id())
    ->where('year', $carbonDate->year)
    ->where('month', $carbonDate->month)
    ->first();


    if ($budget) {
        $budget->total_expenses -= $expense->amount;
        $budget->remaining_balance = $budget->salary - $budget->total_expenses;
        $budget->save();
    }
    $expense->delete();
    return redirect()->route('expenses.index')->with('success', 'Expense deleted and budget updated!');
}


    public function show(Expense $expense)
    {
        $this->authorizeExpense($expense);
        return view('dashboard.expenses.show', compact('expense'));
    }


    private function authorizeExpense(Expense $expense)
    {
        if ($expense->user_id !== auth()->id()) {
            abort(403, 'You are not authorized to access this expense.');
        }
    }
}
