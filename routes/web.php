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

// Email
Route::get('/test', function () {
  Mail::raw('Hi, welcome user!', function ($message) {
    $message->to('vinniehat@gmail.com')
    ->subject('Free 123');
});
  return 'Email Sent';
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

// Admin/Users
Route::get('/admin/users/view/{id}', [\App\Http\Controllers\Admin\Users\UsersController::class, 'view_user'])->name('routes.content.admin.users.view')->can("admin.users.view");

Route::get('/admin/users', [\App\Http\Controllers\Admin\Users\UsersController::class, 'index'])->name('routes.content.admin.users.index')->can("admin.users.view");
Route::post('/admin/users/disable', [\App\Http\Controllers\Admin\Users\UsersController::class, 'disable_user'])->name('routes.content.admin.users.disable')->can("admin.users.disable");
Route::post('/admin/users/enable', [\App\Http\Controllers\Admin\Users\UsersController::class, 'enable_user'])->name('routes.content.admin.users.enable')->can("actions.admin.users.enable");
Route::post('/admin/users/edit', [\App\Http\Controllers\Admin\Users\UsersController::class, 'edit_user'])->name('routes.content.admin.users.edit')->can("admin.users.edit");
Route::post('/admin/users/edit-roles/{id}', [\App\Http\Controllers\Admin\Users\UsersController::class, 'edit_roles'])->name('routes.content.admin.users.edit-roles')->can("admin.settings.users.edit-roles");

// Admin/Settings
Route::get('/admin/settings/auditlog', [\App\Http\Controllers\Admin\Settings\AuditLogController::class, 'index'])->name('routes.content.admin.settings.auditlog.index')->can("admin.settings.auditlog.view");
Route::get('/admin/settings/auditlog/view/{id}', [\App\Http\Controllers\Admin\Settings\AuditLogController::class, 'view'])->name('routes.content.admin.settings.auditlog.view')->can("admin.settings.auditlog.view");

Route::get('/admin/settings/roles', [\App\Http\Controllers\Admin\Settings\RolesController::class, 'index'])->name('routes.content.admin.settings.roles.index')->can("admin.settings.roles.view");
Route::post('/admin/settings/roles/edit/{id}', [\App\Http\Controllers\Admin\Settings\RolesController::class, 'edit'])->name('routes.content.admin.settings.roles.edit')->can("admin.settings.roles.edit");
Route::post('/admin/settings/roles/delete/{id}', [\App\Http\Controllers\Admin\Settings\RolesController::class, 'delete'])->name('routes.content.admin.settings.roles.delete')->can("admin.settings.roles.delete");
Route::post('/admin/settings/roles/create', [\App\Http\Controllers\Admin\Settings\RolesController::class, 'create'])->name('routes.content.admin.settings.roles.create')->can("admin.settings.roles.create");
Route::post('admin/settings/roles/edit-permissions/{id}', [\App\Http\Controllers\Admin\Settings\RolesController::class, 'edit_permissions'])->name('routes.content.admin.settings.roles.edit-permissions')->can("admin.settings.roles.edit-permissions");


Route::get('/admin/settings/permissions', [\App\Http\Controllers\Admin\Settings\PermissionsController::class, 'index'])->name('routes.content.admin.settings.permissions.index')->can("actions.admin.settings.permissions.view");
Route::post('/admin/settings/permissions/edit/{id}', [\App\Http\Controllers\Admin\Settings\PermissionsController::class, 'edit'])->name('routes.content.admin.settings.permissions.edit')->can("actions.admin.settings.permissions.edit");
Route::get('/admin/settings/permissions/view/{id}', [\App\Http\Controllers\Admin\Settings\PermissionsController::class, 'view'])->name('routes.content.admin.settings.permissions.view')->can("admin.settings.permissions.view");
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
  Route::get('/dashboard', [\App\Http\Controllers\Dashboard\HomePage::class, 'index'])->name('routes.content.dashboard.index')->can("dashboard.view");
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
