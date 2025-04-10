<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SavingGoal;
use App\Models\Budget;
use App\Models\Expense;

use Illuminate\Support\Facades\Auth;

class SavingGoalController extends Controller
{
    public function index()
    {
        $savingsGoals = SavingGoal::where('user_id', Auth::id())->get();
        return view('dashboard.savings.index', compact('savingsGoals'));
    }

    public function create()
    {
        $budgets = Budget::where('user_id', auth()->id())
                         ->orderByDesc('year')
                         ->orderByDesc('month')
                         ->get();

        return view('dashboard.savings.create', compact('budgets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'goal_name' => 'required|string|max:255',
            'goal_amount' => 'required|numeric|min:1',
            'monthly_income' => 'required|numeric|min:1',
            'saving_percentage' => 'required|integer|in:5,10,15,20',
            'budget_id' => 'required|exists:budgets,id',
        ]);

        $monthlySaving = $request->monthly_income * ($request->saving_percentage / 100);
        $remainingMonths = ceil($request->goal_amount / $monthlySaving);

        $budget = Budget::find($request->budget_id);
        $canAfford = ($budget->total_expenses + $monthlySaving) <= $budget->salary;

        if (!$canAfford) {
            return redirect()->back()->withErrors([
                'goal_amount' => 'التوفير الشهري يتجاوز دخلك المتاح لهذا الشهر.'
            ])->withInput();
        }

        SavingGoal::create([
            'goal_name' => $request->goal_name,
            'goal_amount' => $request->goal_amount,
            'monthly_income' => $request->monthly_income,
            'saving_percentage' => $request->saving_percentage,
            'monthly_savings' => $monthlySaving,
            'remaining_months' => $remainingMonths,
            'saved_amount' => 0,
            'budget_id' => $request->budget_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('savings.index')->with('success', 'تمت إضافة هدف التوفير بنجاح!');
    }

    public function edit($id)
    {
        $savingsGoal = SavingGoal::find($id);

        if (!$savingsGoal) {
            return redirect()->route('savings.index')->with('error', 'هدف التوفير غير موجود!');
        }

        $budgets = Budget::where('user_id', auth()->id())->get();
        return view('dashboard.savings.edit', compact('savingsGoal', 'budgets'));
    }

    public function update(Request $request, $id)
    {
        $savingsGoal = SavingGoal::find($id);

        if (!$savingsGoal) {
            return redirect()->route('savings.index')->with('error', 'هدف التوفير غير موجود!');
        }

        $request->validate([
            'goal_name' => 'required|string|max:255',
            'goal_amount' => 'required|numeric|min:1',
            'monthly_income' => 'required|numeric|min:1',
            'saving_percentage' => 'required|integer|in:5,10,15,20',
            'budget_id' => 'required|exists:budgets,id',
        ]);

        $monthlySaving = $request->monthly_income * ($request->saving_percentage / 100);
        $remainingMonths = ceil($request->goal_amount / $monthlySaving);

        $savingsGoal->update([
            'goal_name' => $request->goal_name,
            'goal_amount' => $request->goal_amount,
            'monthly_income' => $request->monthly_income,
            'saving_percentage' => $request->saving_percentage,
            'monthly_savings' => $monthlySaving,
            'remaining_months' => $remainingMonths,
            'budget_id' => $request->budget_id,
        ]);

        return redirect()->route('savings.index')->with('success', 'تم تحديث هدف التوفير بنجاح!');
    }

    public function updateSavings()
    {
        $goals = SavingGoal::where('user_id', Auth::id())->get();
        $totalExpenses = Expense::where('user_id', Auth::id())->sum('amount');

        foreach ($goals as $goal) {
            $remainingSalary = $goal->monthly_income - $totalExpenses;

            if ($remainingSalary > 0) {
                $goal->update(['saved_amount' => $remainingSalary]);

                if ($goal->remaining_months <= 3 && $goal->saved_amount > 0) {
                    $message = "رائع! تبقى لك {$goal->remaining_months} أشهر للوصول إلى هدفك، وقد ادخرت " .
                               number_format($goal->saved_amount, 2) . " د.ا من أصل " .
                               number_format($goal->goal_amount, 2) . " د.ا 💪";

                    Auth::user()->notify(new \App\Notifications\CustomGoalNotification($message));
                }

                if ($goal->saved_amount >= $goal->goal_amount) {
                    Auth::user()->notify(new \App\Notifications\SavingGoalAchieved());
                }
            }
        }

        return redirect()->route('savings.index')->with('success', 'تم تحديث المدخرات بنجاح!');
    }

    public function destroy($id)
    {
        $savingsGoal = SavingGoal::find($id);

        if (!$savingsGoal) {
            return redirect()->route('savings.index')->with('error', 'هدف التوفير غير موجود!');
        }

        if ($savingsGoal->delete()) {
            return redirect()->route('savings.index')->with('success', 'تم حذف هدف التوفير بنجاح!');
        } else {
            return redirect()->route('savings.index')->with('error', 'حدث خطأ أثناء حذف هدف التوفير!');
        }
    }

}
