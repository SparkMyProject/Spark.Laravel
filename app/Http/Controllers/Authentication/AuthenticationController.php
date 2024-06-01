<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\Authentication\OAuthUser;
use App\Models\Authentication\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationController extends Controller
{
  /**
   * Show the login form.
   */

  public function showLoginForm()
  {
    return view('auth.login');

  }

  /**
   * Show the registration form.
   */
  public function showRegisterForm()
  {
    return view('auth.register');
  }
  // TODO: Add registration functionality

  /**
   * Handle a registration attempt.
   */

  public function register(Request $request): RedirectResponse
  {
    $credentials = $request->validate([
      'username' => ['required', 'max:20'],
      'password' => ['required', 'confirmed'],
    ]);

    // Create the user
    $user = User::create([
      'username' => $credentials['username'],
      'password' => Hash::make($credentials['password']),
      'account_status' => 'Active',
    ]);

    // Log the user in
    Auth::login($user);

    // Redirect the user
    return redirect()->intended('dashboard');
  }

  /**
   * Discord OAuth Redirect
   */
  public function discordRedirect()
  {
    return Socialite::driver('discord')->stateless()->redirect();
  }

  /**
   * Discord OAuth Callback
   */
  public function discordCallback()
    // TODO: Fix Discord PFPs
  {
    $discordUser = Socialite::driver('discord')->stateless()->user();

    $oauthUser = OAuthUser::where('provider_id', $discordUser->id)->first();
    $user = $oauthUser ? $oauthUser->user : null;

//    $avatarContent = file_get_contents($discordUser->avatar);
//    $idHash = md5($discordUser->id);
//    $avatarPath = 'avatars/' . $idHash . '.png'; // must match services.php
////    Storage::put($avatarPath, $avatarContent);
//
//// ...


    if ($user) {

      // Check the user's status
      switch ($user->account_status) {
        case 'Disabled':
          return redirect()->route('login')->with('error', 'Your account has been disabled. Please contact an administrator.');
        case 'Banned':
          return redirect()->route('login')->with('error', 'Your account has been banned. Please contact an administrator.');
      }

      $oauthUser->update([
        'username' => $discordUser->nickname,
        'email' => $discordUser->email,
        'avatar' => $discordUser->avatar,

      ]);
      $user->update([
        'email' => $discordUser->email,

      ]);
      $user->oauthUser()->save($oauthUser);
      $user->save();

      // Uncomment this line to update the user's avatar each login
      // $user->setDiscordAvatar(); // this automatically saves

    } else {
      $user = User::make([
        'name' => $discordUser->name,
        'email' => $discordUser->email,
        'username' => $discordUser->nickname,
      ])->assignRole('User');
      $user->password = bcrypt(Str::random(16));
      $user->save();


      $oauthUser = OAuthUser::create([
        'user_id' => $user->id,
        'provider_id' => $discordUser->id,
        'email' => $discordUser->email,
        'username' => $discordUser->nickname,
        'avatar' => $discordUser->avatar,
      ]);
      $user->setDiscordAvatar(); // this automatically saves
    }

    Auth::login($user);

    return redirect('/dashboard');
  }

  /**
   * Handle an authentication attempt.
   */
  public function authenticate(Request $request): RedirectResponse
  {
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
