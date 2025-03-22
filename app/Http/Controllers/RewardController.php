<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index()
    {
        // Fetch all rewards with pagination
        $rewards = Reward::paginate(10); // You can adjust pagination as needed
        return view('dashboard.Reward.index', compact('rewards'));
    }

    /**
     * Show the form for creating a new reward.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.Reward.create');
    }

    /**
     * Store a newly created reward in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Ensure the user is authenticated
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to create a reward.');
    }

    // Validate the input
    $request->validate([
        'reward_name' => 'required|string|max:255',
        'points' => 'required|integer',
    ]);

    // Get the authenticated user's ID
    $user_id = auth()->id();

    // Create the reward and associate the user
    Reward::create([
        'reward_name' => $request->reward_name,
        'points' => $request->points,
        'user_id' => $user_id, // Add user_id to the record
    ]);

    // Redirect to the rewards list with a success message
    return redirect()->route('rewards.index')->with('success', 'Reward created successfully!');
}


    /**
     * Display the specified reward.
     *
     * @param \App\Models\Reward $reward
     * @return \Illuminate\Http\Response
     */
    public function show(Reward $reward)
    {
        return view('dashboard.Reward.show', compact('reward'));
    }

    /**
     * Show the form for editing the specified reward.
     *
     * @param \App\Models\Reward $reward
     * @return \Illuminate\Http\Response
     */
    public function edit(Reward $reward)
    {
        return view('dashboard.Reward.edit', compact('reward'));
    }

    /**
     * Update the specified reward in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Reward $reward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reward $reward)
    {
        // Validate the input
        $request->validate([
            'reward_name' => 'required|string|max:255',
            'points' => 'required|integer',
        ]);

        // Update the reward
        $reward->update([
            'reward_name' => $request->reward_name,
            'points' => $request->points,
        ]);

        // Redirect to the rewards list with success message
        return redirect()->route('rewards.index')->with('success', 'Reward updated successfully!');
    }

    /**
     * Remove the specified reward from storage.
     *
     * @param \App\Models\Reward $reward
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reward $reward)
    {
        // Delete the reward
        $reward->delete();

        // Redirect to the rewards list with success message
        return redirect()->route('rewards.index')->with('success', 'Reward deleted successfully!');
    }
}
