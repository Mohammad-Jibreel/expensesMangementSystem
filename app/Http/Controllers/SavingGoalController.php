<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SavingGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goals = SavingGoal::where('user_id', Auth::id())->get();
        return view('savings.index', compact('goals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'target_amount' => 'required|numeric|min:1',
            'duration' => 'required|string',
        ]);

        $endDate = match ($request->duration) {
            '6 أشهر' => now()->addMonths(6),
            'شهري' => now()->addMonth(),
            'سنوي' => now()->addYear(),
            default => now()
        };

        SavingGoal::create([
            'user_id' => Auth::id(),
            'target_amount' => $request->target_amount,
            'saved_amount' => 0,
            'duration' => $request->duration,
            'start_date' => now(),
            'end_date' => $endDate,
        ]);

        return redirect()->route('savings.index')->with('success', 'تم إنشاء الهدف بنجاح!');
    }

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

}
