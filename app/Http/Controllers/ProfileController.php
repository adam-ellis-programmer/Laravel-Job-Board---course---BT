<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        // Get the authenticated user
        $user = Auth::user();

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // 'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        // Get user name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');


        // Handle file upload
        if ($request->hasFile('avatar')) {

            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::delete('public/' . $user->avatar);
            }

            // Store new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // *** keep for reference *** //
        // Update the user's information
        // $user->update($validatedData);
        // if ($user instanceof User) {
        //     $user->update($validatedData);
        // }


        // dd($avatarPath);


        if ($user instanceof User) {
            $user->save();
        }

        // Redirect back to the dashboard page with a success message
        return redirect()->route('dashboard')->with('success', 'User info updated successfully!');
    }
}
