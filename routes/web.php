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

Route::get('/page-2', [Page2::class, 'index'])->name('pages-page-2');

// locale
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

// pages
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');

// Admin/Users
Route::get('/admin/users', [\App\Http\Controllers\Admin\Users\UsersController::class, 'index'])->name('routes.content.admin.users.index')->can("actions.admin.users.view");
Route::post('/admin/users/disable', [\App\Http\Controllers\Admin\Users\UsersController::class, 'disable_user'])->name('routes.content.admin.users.disable')->can("actions.admin.users.disable");
Route::post('/admin/users/enable', [\App\Http\Controllers\Admin\Users\UsersController::class, 'enable_user'])->name('routes.content.admin.users.enable')->can("actions.admin.users.enable");


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
  Route::get('/dashboard', [\App\Http\Controllers\Dashboard\HomePage::class, 'index'])->can("content.dashboard.index.view")->name('routes.content.dashboard.index');
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
    $user = User::create([
      'name' => $discordUser->name,
      'email' => $discordUser->email,
      'username' => $discordUser->nickname,
      'profile_photo_path' => $avatarPath,
      'password' => bcrypt(Str::random(24)),
    ])->assignRole('User');

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
