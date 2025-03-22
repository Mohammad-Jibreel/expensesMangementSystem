<?php

namespace App\Http\Controllers;

use App\Models\GroupExpense;
use App\Models\Group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupExpenseController extends Controller
{
    public function index()
    {
        $expenses = GroupExpense::all();
        return view('dashboard.GroupExpense.index', compact('expenses'));
    }

    public function create()
    {
        $groups = Group::all();

        // Pass the groups variable to the view
        return view('dashboard.GroupExpense.create', compact('groups'));
        }

    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'description' => 'nullable|string'
        ]);

        GroupExpense::create($request->all());
        return redirect()->route('group-expenses.index');
    }

    public function show(GroupExpense $groupExpense)
    {
        return view('dashboard.GroupExpense.show', compact('groupExpense'));
    }

    public function edit(GroupExpense $groupExpense)
    {
        return view('dashboard.GroupExpense.edit', compact('groupExpense'));
    }

    public function update(Request $request, GroupExpense $groupExpense)
    {
        $groupExpense->update($request->all());
        return redirect()->route('group-expenses.index');
    }

    public function destroy(GroupExpense $groupExpense)
    {
        $groupExpense->delete();
        return redirect()->route('group-expenses.index');
    }
}
