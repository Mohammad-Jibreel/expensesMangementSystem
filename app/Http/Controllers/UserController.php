<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
      // Show the user's profile
      public function show()
      {
          return view('dashboard.profile.show', ['user' => Auth::user()]);
      }

      // Show the form to edit the user's profile
      public function edit()
      {
          return view('dashboard.profile.edit', ['user' => Auth::user()]);
      }

      // Update the user's profile
      public function update(Request $request)
      {
          // Validate the input fields
          $request->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
              'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for image
          ]);

          $user = Auth::user();

          // Update name and email
          $user->name = $request->input('name');
          $user->email = $request->input('email');

          // Handle profile image upload
          if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image && Storage::exists('public/profile_images/' . $user->profile_image)) {
                Storage::delete('public/profile_images/' . $user->profile_image);
            }

            // Store new image and get the file name
            $imageName = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = basename($imageName); // Save the image filename in the database
        }

          $user->save(); // Save the updated user details

          return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
      }

}
