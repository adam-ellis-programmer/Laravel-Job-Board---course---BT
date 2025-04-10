<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use types 
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Hash;
use App\Models\User;


class RegisterController extends Controller
{
    public function register(): View
    {
        return view('auth.register');
    }

    // need to use the request object
    public function store(Request $request): RedirectResponse
    {

        // Validate the incoming request data
        // rules that we want 
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // looks in users table
            'password' => 'required|string|min:8|confirmed', // looks for password_confirmation
        ]);

        // Hash the password -- uses bcrypt
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create a new user
        $user = User::create($validatedData);

        // directed to login page 
        return redirect()->route('login')->with('success', 'Registration successful You can now log in!');

        // print_r($validatedData);
        // die();
    }
}
