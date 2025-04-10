<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  // @desc  Show login form
  // @route GET /login
  public function login(): View
  {
    return view('auth.login');
  }

  // @desc  Show login form
  // @route POST /login
  public function authenticate(Request $request): RedirectResponse
  {
    // Validate the request data
    $credentials = $request->validate([
      'email' => 'required|email',
      'password' => 'required|string',
    ]);

    // dd($credentials);

    // Attempt to log the user in
    if (Auth::attempt($credentials)) {
      // Regenerate the session to prevent fixation attacks
      $request->session()->regenerate();

      // we say home as we named this in the router -> use...
      // Redirect to the intended route or a default route
      return redirect()->intended(route('home'))->with('success', 'You are now logged in!');
    }


    // If authentication fails, redirect back with an error message
    return back()->withErrors([
      'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
  }


  public function logout(Request $request): RedirectResponse
  {
    Auth::logout(); // Log out the user

    $request->session()->invalidate(); // Invalidate the session
    $request->session()->regenerateToken(); // Regenerate the CSRF token

    return redirect('/');
  }
}
