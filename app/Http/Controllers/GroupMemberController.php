<?php

namespace App\Http\Controllers;

use App\Models\GroupMember;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupMemberController extends Controller
{
    public function index()
    {
        $members = GroupMember::all();
        return view('dashboard.GroupMember.index', compact('members'));
    }

    public function create()
    {
        return view('dashboard.GroupMember.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'user_id' => 'required|exists:users,id'
        ]);

        GroupMember::create($request->all());
        return redirect()->route('group-members.index');
    }

    public function show(GroupMember $groupMember)
    {
        return view('dashboard.GroupMember.show', compact('groupMember'));
    }

    public function edit(GroupMember $groupMember)
    {
        return view('dashboard.GroupMember.edit', compact('groupMember'));
    }

    public function update(Request $request, GroupMember $groupMember)
    {
        $groupMember->update($request->all());
        return redirect()->route('group-members.index');
    }

    public function destroy(GroupMember $groupMember)
    {
        $groupMember->delete();
        return redirect()->route('group-members.index');
    }
}
