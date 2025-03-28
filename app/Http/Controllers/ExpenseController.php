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

        // Parse the date input (or use the current date if not provided)
        $carbonDate = Carbon::parse($request->date ?: now());  // Defaults to current date if 'date' is null

        // Extract the year and month from the date
        $year = $carbonDate->year;
        $month = $carbonDate->month;

        // Find the user's budget for the specific month and year
        $budget = Budget::where('user_id', auth()->id())
                        ->where('year', $year)
                        ->where('month', $month)->first();

        if (!$budget) {
            // If there is no budget for the user for the specified month, create a new one
            $budget = Budget::create([
                'user_id' => auth()->id(),
                'salary' => 0, // Initially set to 0, you can update it manually later
                'year' => $year,
                'month' => $month,
            ]);
        }

        if ($request->amount <= 0) {
            return redirect()->back()->withErrors(['amount' => 'Expense amount must be greater than zero!']);
        }

        if (($budget->total_expenses + $request->amount) > $budget->salary) {
            return redirect()->back()->withErrors(['amount' => 'Expense exceeds available balance for this month!']);
        }

        // Add the expense to the expense table only if validation passes
        $expense = Expense::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'date' => $carbonDate->toDateString(),  // Convert date to 'Y-m-d'
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);


        // Update the total expenses in the budget table
        $budget->total_expenses += $expense->amount;

        // Update the remaining balance
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

        $expense->update([
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
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
            abort(403, 'You are not authorized to access this expense.');
        }
    }
}
