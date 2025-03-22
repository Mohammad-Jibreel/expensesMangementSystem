<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index()
    {
        $challenges = Challenge::all();
        return view('challenges.index', compact('challenges'));
    }

    public function create()
    {
        return view('challenges.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'challenge_name' => 'required|string',
            'completed' => 'required|boolean'
        ]);

        Challenge::create($request->all());
        return redirect()->route('challenges.index');
    }

    public function show(Challenge $challenge)
    {
        return view('challenges.show', compact('challenge'));
    }

    public function edit(Challenge $challenge)
    {
        return view('challenges.edit', compact('challenge'));
    }

    public function update(Request $request, Challenge $challenge)
    {
        $challenge->update($request->all());
        return redirect()->route('challenges.index');
    }

    public function destroy(Challenge $challenge)
    {
        $challenge->delete();
        return redirect()->route('challenges.index');
    }
}
