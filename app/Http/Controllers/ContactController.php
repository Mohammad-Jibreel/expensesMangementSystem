<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'message' => 'required|string',
    ]);

    Contact::create([
        'user_id' => Auth::id(), // Automatically get the logged-in user's ID
        'name' => Auth::user()->name, // Get logged-in user's name
        'email' => Auth::user()->email, // Get logged-in user's email
        'message' => $request->message,
    ]);

    return redirect()->back()->with('success', 'Message sent successfully!');
}
}
