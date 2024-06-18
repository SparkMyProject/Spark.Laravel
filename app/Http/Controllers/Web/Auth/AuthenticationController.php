<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Authentication\Hash;
use App\Http\Controllers\Web\Controller;
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
    $this->data['title'] = trans('backpack::base.login'); // set the page title
    $this->data['username'] = '';

    return view(backpack_view('auth.login'), $this->data);
  }

  /**
   * Show the registration form.
   */
  public function showRegistrationForm()
  {
    return view('auth.register');
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
  {
    $discordUser = Socialite::driver('discord')->stateless()->user();

    $oauthUser = OAuthUser::where('provider_id', $discordUser->id)->first();
    $user = $oauthUser ? $oauthUser->user : null;


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

      $user->markEmailAsVerified();

      $user->syncDiscordAvatar(); // this automatically saves

    }

    Auth::login($user);

    return redirect('/dashboard');
  }

  /**
   * Handle an authentication attempt.
   */
  public function authenticate(Request $request): RedirectResponse
  {
    dd($request->all());
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
