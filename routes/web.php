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
Route::get('/admin/users/view/{id}', [\App\Http\Controllers\Admin\Users\UsersController::class, 'view_user'])->name('routes.content.admin.users.view')->can("actions.admin.users.view");

Route::get('/admin/users', [\App\Http\Controllers\Admin\Users\UsersController::class, 'index'])->name('routes.content.admin.users.index')->can("actions.admin.users.view");
Route::post('/admin/users/disable', [\App\Http\Controllers\Admin\Users\UsersController::class, 'disable_user'])->name('routes.content.admin.users.disable')->can("actions.admin.users.disable");
Route::post('/admin/users/enable', [\App\Http\Controllers\Admin\Users\UsersController::class, 'enable_user'])->name('routes.content.admin.users.enable')->can("actions.admin.users.enable");
Route::post('/admin/users/edit', [\App\Http\Controllers\Admin\Users\UsersController::class, 'edit_user'])->name('routes.content.admin.users.edit')->can("actions.admin.users.edit");

// Admin/Settings
Route::get('/admin/settings/auditlog', [\App\Http\Controllers\Admin\Settings\AuditLogController::class, 'index'])->name('routes.content.admin.settings.auditlog.index')->can("actions.admin.settings.auditlog.view");
Route::get('/admin/settings/auditlog/view/{id}', [\App\Http\Controllers\Admin\Settings\AuditLogController::class, 'view'])->name('routes.content.admin.settings.auditlog.view')->can("routes.content.admin.settings.auditlog.view");
Route::get('/admin/settings/roles', [\App\Http\Controllers\Admin\Settings\RolesController::class, 'index'])->name('routes.content.admin.settings.roles.index')->can("actions.admin.settings.roles.view");
Route::post('/admin/settings/roles/edit/{id}', [\App\Http\Controllers\Admin\Settings\RolesController::class, 'edit'])->name('routes.content.admin.settings.roles.edit')->can("actions.admin.settings.roles.edit");
Route::get('/admin/settings/permissions', [\App\Http\Controllers\Admin\Settings\PermissionsController::class, 'index'])->name('routes.content.admin.settings.permissions.index')->can("actions.admin.settings.permissions.view");
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
  Route::get('/dashboard', [\App\Http\Controllers\Dashboard\HomePage::class, 'index'])->can("actions.dashboard.index.view")->name('routes.content.dashboard.index');
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
