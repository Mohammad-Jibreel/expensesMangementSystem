<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SavingGoal;
use Illuminate\Support\Facades\Auth;

class SavingGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $savingsGoals = SavingGoal::where('user_id', Auth::id())->get();
        return view('dashboard.savings.index', compact('savingsGoals'));
    }

    public function create()
    {
        return view('dashboard.savings.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Find the savings goal by ID
        $savingsGoal = SavingGoal::find($id);

        // Check if the savings goal exists
        if (!$savingsGoal) {
            return redirect()->route('savings.index')->with('error', 'Savings goal not found!');
        }

        // Return the view with the savings goal data
        return view('dashboard.savings.edit', compact('savingsGoal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'goal_name' => 'required|string|max:255',
            'goal_amount' => 'required|numeric',
            'remaining_months' => 'required|integer',
            'budget_id' => 'required|exists:budgets,id', // Ensure the budget exists
        ]);

        // Create a new savings goal
        SavingGoal::create([
            'goal_name' => $request->goal_name,
            'goal_amount' => $request->goal_amount,
            'monthly_savings' => $request->goal_amount / $request->remaining_months, // Calculate monthly savings
            'remaining_months' => $request->remaining_months,
            'saved_amount' => 0, // Starting point: no amount saved yet
            'budget_id' => $request->budget_id, // Associate with the selected budget
            'user_id' => auth()->id(), // Associate with the logged-in user
        ]);

        return redirect()->route('savings.index')->with('success', 'Savings goal added successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the savings goal by ID
        $savingsGoal = SavingGoal::find($id);

        // Check if the savings goal exists
        if (!$savingsGoal) {
            return redirect()->route('savings.index')->with('error', 'Savings goal not found!');
        }

        // Validate the request data
        $request->validate([
            'goal_name' => 'required|string|max:255',
            'goal_amount' => 'required|numeric',
            'remaining_months' => 'required|integer',
            'budget_id' => 'required|exists:budgets,id',
        ]);

        // Update the savings goal
        $savingsGoal->update([
            'goal_name' => $request->goal_name,
            'goal_amount' => $request->goal_amount,
            'monthly_savings' => $request->goal_amount / $request->remaining_months, // Recalculate monthly savings
            'remaining_months' => $request->remaining_months,
            'budget_id' => $request->budget_id, // Update associated budget
        ]);

        return redirect()->route('savings.index')->with('success', 'Savings goal updated successfully!');
    }

    /**
     * Update the savings status for all goals based on income and expenses.
     */
    public function updateSavings()
    {
        $goals = SavingGoal::where('user_id', Auth::id())->get();
        $totalIncome = 5000; // Example salary, you can replace it with actual income data
        $totalExpenses = Expense::where('user_id', Auth::id())->sum('amount');

        foreach ($goals as $goal) {
            $savedAmount = $totalIncome - $totalExpenses;
            if ($savedAmount > 0) {
                $goal->update(['saved_amount' => $savedAmount]);

                // ✅ Notify the user when they reach their saving goal
                if ($goal->saved_amount >= $goal->target_amount) {
                    Auth::user()->notify(new SavingGoalAchieved());
                }
            }
        }

        return redirect()->route('savings.index')->with('success', 'تم تحديث المدخرات بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $savingsGoal = SavingGoal::find($id);

        // Check if the savings goal exists
        if (!$savingsGoal) {
            return redirect()->route('savings.index')->with('error', 'Savings goal not found!');
        }

        // Attempt to delete the savings goal
        $deleted = $savingsGoal->delete();

        if ($deleted) {
            return redirect()->route('savings.index')->with('success', 'Savings goal deleted successfully!');
        } else {
            return redirect()->route('savings.index')->with('error', 'There was an error deleting the savings goal!');
        }
    }
}
