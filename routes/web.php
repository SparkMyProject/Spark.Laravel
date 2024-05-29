<?php

use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\FrontPages\FrontPages;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\Page2;
use Illuminate\Support\Facades\Route;
use App\Models\Authentication\OAuthUser;
use App\Models\Authentication\User;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Main Page Route
Route::get('/', [FrontPages::class, 'index'])->name('routes.content.pages.landing-page');

Route::get('/exception', function () {
  throw new Exception('This is a test exception.');
});

// locale
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

// pages (without controller)
Route::get('/misc/errors/not-authorized', function () {
  return view('misc.errors.not-authorized');
})->name('routes.misc.errors.not-authorized');

Route::get('/misc/errors/not-found', function () {
  return view('misc.errors.not-found');
})->name('routes.misc.errors.not-found');

Route::get('/misc/errors/acct-banned', function () {
  return view('misc.errors.acct-banned');
})->name('routes.misc.errors.acct-banned');


// Authentication Routes, overriding Jetstream routes
Route::get('login', [\App\Http\Controllers\Authentication\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [\App\Http\Controllers\Authentication\LoginController::class, 'authenticate']);
Route::post('logout', [\App\Http\Controllers\Authentication\LoginController::class, 'logout'])->name('logout');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
  Route::get('/dashboard', [\App\Http\Controllers\Dashboard\HomePage::class, 'index'])->name('routes.content.dashboard.index')->middleware("canCustom:dashboard.view");
});

Route::get('/auth/discord/redirect', function () {
  return Socialite::driver('discord')->stateless()->redirect();
})->name('auth.discord.redirect');

Route::get('/auth/discord/callback', function () {
  $discordUser = Socialite::driver('discord')->stateless()->user();

  $oauthUser = OAuthUser::where('provider_id', $discordUser->id)->first();
  $user = $oauthUser ? $oauthUser->user : null;

  $avatarContent = file_get_contents($discordUser->avatar);
  $avatarPath = 'avatars/' . $discordUser->id . '.png'; // must match services.php
  Storage::put($avatarPath, $avatarContent);


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
      'profile_photo_path' => $avatarPath,

    ]);
    $user->oauthUser()->save($oauthUser);
    $user->save();
  } else {
    $user = User::make([
      'name' => $discordUser->name,
      'email' => $discordUser->email,
      'username' => $discordUser->nickname,
      'profile_photo_path' => $avatarPath,
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
  }

  Auth::login($user);

  return redirect('/dashboard');
})->name('auth.discord.callback');
