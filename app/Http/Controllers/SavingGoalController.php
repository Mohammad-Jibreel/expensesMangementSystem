<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SavingGoal;
use App\Models\Budget;

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
        $budgets = Budget::where('user_id', auth()->id())->orderByDesc('year')->orderByDesc('month')->get();
return view('dashboard.savings.create', compact('budgets'));

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
    $request->validate([
        'goal_name' => 'required|string|max:255',
        'goal_amount' => 'required|numeric',
        'remaining_months' => 'required|integer|min:1',
        'budget_id' => 'required|exists:budgets,id',
    ]);

    $budget = Budget::find($request->budget_id);

    // Calculate monthly savings
    $monthlySaving = $request->goal_amount / $request->remaining_months;

    // Check if user can afford this goal
    $canAfford = ($budget->total_expenses + $monthlySaving) <= $budget->salary;

    if (!$canAfford) {
        return redirect()->back()->withErrors([
            'goal_amount' => 'Monthly saving goal exceeds your budget for this month.'
        ])->withInput();
    }

    // Create savings goal
    SavingGoal::create([
        'goal_name' => $request->goal_name,
        'goal_amount' => $request->goal_amount,
        'monthly_savings' => $monthlySaving,
        'remaining_months' => $request->remaining_months,
        'saved_amount' => 0,
        'budget_id' => $request->budget_id,
        'user_id' => auth()->id(),
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
        $totalIncome = 5000; // 👈 استبدل هذا بـ budget->salary الحقيقي
        $totalExpenses = Expense::where('user_id', Auth::id())->sum('amount');

        foreach ($goals as $goal) {
            $savedAmount = $totalIncome - $totalExpenses;

            if ($savedAmount > 0) {
                $goal->update(['saved_amount' => $savedAmount]);

                // ✅ إشعار إذا اقترب من تحقيق الهدف
                if ($goal->remaining_months <= 3 && $goal->saved_amount > 0) {
                    $message = "رائع! تبقى لك {$goal->remaining_months} أشهر للوصول إلى هدفك، وقد ادخرت " .
                               number_format($goal->saved_amount, 2) . " د.ا من أصل " .
                               number_format($goal->goal_amount, 2) . " د.ا 💪";

                    Auth::user()->notify(new \App\Notifications\CustomGoalNotification($message));
                }

                // ✅ إشعار عند تحقيق الهدف
                if ($goal->saved_amount >= $goal->goal_amount) {
                    Auth::user()->notify(new \App\Notifications\SavingGoalAchieved());
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
