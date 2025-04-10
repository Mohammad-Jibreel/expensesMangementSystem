<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SavingGoal;
use App\Models\Budget;
use App\Models\Expense;
use App\Notifications\SavingReminder;

use Illuminate\Support\Facades\Auth;

class SavingGoalController extends Controller
{
    public function index()
    {
        $savingsGoals = SavingGoal::where('user_id', Auth::id())->get();
        Auth::user()->unreadNotifications->markAsRead();

    foreach ($savingsGoals as $goal) {
        Auth::user()->notify(new SavingReminder($goal->goal_name));
    }
        return view('dashboard.savings.index', compact('savingsGoals'));
    }

    // Show the form for creating a new savings goal
    public function create()
    {
        $budgets = Budget::where('user_id', auth()->id())
                         ->orderByDesc('year')
                         ->orderByDesc('month')
                         ->get();

        return view('dashboard.savings.create', compact('budgets'));
    }

    // Store a newly created savings goal in the database
    public function store(Request $request)
    {
        $request->validate([
            'goal_name' => 'required|string|max:255',
            'goal_amount' => 'required|numeric|min:1',
            'saving_percentage' => 'required|integer|in:5,10,15,20',
            'budget_id' => 'required|exists:budgets,id',
        ]);

        // Calculate monthly savings and remaining months
        $monthlySaving = $request->goal_amount * ($request->saving_percentage / 100);
        $remainingMonths = ceil($request->goal_amount / $monthlySaving);

        // Get the selected budget
        $budget = Budget::find($request->budget_id);

        // Check if the user can afford the savings goal
        $canAfford = ($budget->total_expenses + $monthlySaving) <= $budget->salary;

        if (!$canAfford) {
            return redirect()->back()->withErrors([
                'goal_amount' => 'The monthly savings exceed your available income for this month.'
            ])->withInput();
        }

        // Create the savings goal
        SavingGoal::create([
            'goal_name' => $request->goal_name,
            'goal_amount' => $request->goal_amount,
            'saving_percentage' => $request->saving_percentage,
            'monthly_savings' => $monthlySaving,
            'remaining_months' => $remainingMonths,
            'saved_amount' => 0,
            'budget_id' => $request->budget_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('savings.index')->with('success', 'Saving goal added successfully!');
    }

    // Show the form for editing a savings goal
    public function edit($id)
    {
        $savingsGoal = SavingGoal::find($id);

        if (!$savingsGoal) {
            return redirect()->route('savings.index')->with('error', 'Saving goal not found!');
        }

        $budgets = Budget::where('user_id', auth()->id())->get();
        return view('dashboard.savings.edit', compact('savingsGoal', 'budgets'));
    }

    // Update the specified savings goal in the database
    public function update(Request $request, $id)
    {
        $savingsGoal = SavingGoal::find($id);

        if (!$savingsGoal) {
            return redirect()->route('savings.index')->with('error', 'Saving goal not found!');
        }

        $request->validate([
            'goal_name' => 'required|string|max:255',
            'goal_amount' => 'required|numeric|min:1',
            'saving_percentage' => 'required|integer|in:5,10,15,20',
            'budget_id' => 'required|exists:budgets,id',
        ]);

        // Calculate monthly savings and remaining months
        $monthlySaving = $request->goal_amount * ($request->saving_percentage / 100);
        $remainingMonths = ceil($request->goal_amount / $monthlySaving);

        // Update the savings goal
        $savingsGoal->update([
            'goal_name' => $request->goal_name,
            'goal_amount' => $request->goal_amount,
            'saving_percentage' => $request->saving_percentage,
            'monthly_savings' => $monthlySaving,
            'remaining_months' => $remainingMonths,
            'budget_id' => $request->budget_id,
        ]);

        return redirect()->route('savings.index')->with('success', 'Saving goal updated successfully!');
    }



    // Delete the specified savings goal
    public function destroy($id)
    {
        $savingsGoal = SavingGoal::find($id);

        if (!$savingsGoal) {
            return redirect()->route('savings.index')->with('error', 'Saving goal not found!');
        }

        if ($savingsGoal->delete()) {
            return redirect()->route('savings.index')->with('success', 'Saving goal deleted successfully!');
        } else {
            return redirect()->route('savings.index')->with('error', 'An error occurred while deleting the saving goal!');
        }
    }

}
