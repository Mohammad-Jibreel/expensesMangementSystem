<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Expense;
use App\Models\SavingGoal;

class DashboardController extends Controller
{
    public function index()
    {
        $salary = Budget::where('user_id', auth()->id())->sum('salary');
        $expenses = Expense::where('user_id', auth()->id())
                            ->whereMonth('created_at', now()->month)
                            ->sum('amount');

        $savings = SavingGoal::where('user_id', auth()->id())->sum('saved_amount');

        $remaining_balance = $salary - $expenses - $savings;

        return view('layouts.index', compact('salary', 'remaining_balance', 'savings', 'expenses'));
    }
}
