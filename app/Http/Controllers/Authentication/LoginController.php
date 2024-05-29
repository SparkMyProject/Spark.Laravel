<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
  public function showLoginForm()
  {
    return view('auth.login');

  }
  /**
   * Handle an authentication attempt.
   */
  public function authenticate(Request $request): RedirectResponse
  {
    // TODO: Fix remember me
    $credentials = $request->validate([
      'username' => ['required', 'max:20'],
      'password' => ['required'],
      'remember' => ['nullable', "in:on,off"],
    ]);

    $remember = isset($credentials['remember']) && $credentials['remember'] === 'on';
    Log::info($remember);

    // Attempt to authenticate the user
    $attempt = Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']], $remember);
    if ($attempt) {
      Log::info("User authenticated");
      $user = Auth::user();

      // Check the user's status
      switch ($user->account_status) {
        case 'Active':
          // If the user is active, regenerate the session and redirect them
          $request->session()->regenerate();
          return redirect()->intended('dashboard');
        case 'Disabled':
          return back()->with('error', 'Your account has been disabled. Please contact an administrator.')->onlyInput('username');
        case 'Banned':
          return back()->with('error', 'Your account has been banned. Please contact an administrator.')->onlyInput('username');
      }
    }
    return back()->withErrors([
      'username' => 'The provided credentials do not match our records.',
    ])->onlyInput('username');
  }

  public function logout(Request $request): RedirectResponse
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
  }
}
