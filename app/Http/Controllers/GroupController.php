<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this line to import the Auth facade

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::paginate(10);
        return view('dashboard.Group.index', compact('groups')); // Display all groups
    }

    public function create()
    {
        return view('dashboard.Group.create'); // Show form to create a new group
    }

    public function store(Request $request)
    {
        $request->validate([
            'group_name' => 'required|string',
        ]);

        $group = new Group();
        $group->group_name = $request->group_name;
        $group->owner_id = Auth::id(); // Set the owner_id to the current authenticated user's ID
        $group->save();

        return redirect()->route('groups.index'); // Redirect back to the group list
    }

    public function show(Group $group)
    {
        return view('dashboard.group.index', compact('group')); // Show a specific group
    }

    public function edit(Group $group)
    {
        return view('dashboard.Group.edit', compact('group')); // Show form to edit a group
    }

    public function update(Request $request, Group $group)
    {
        $group->group_name = $request->group_name;
        $group->owner_id = Auth::id(); // Set the owner_id to the current authenticated user's ID
        $group->save();
        return redirect()->route('groups.index'); // Redirect back to the group list
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('groups.index'); // Redirect back to the group list
    }
}
