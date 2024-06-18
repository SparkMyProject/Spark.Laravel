<?php

// Authentication Routes, overriding Jetstream routes
use Illuminate\Support\Facades\Route;


// Authentication Routes...
Route::get('/authentication/login', [\App\Http\Controllers\Web\Auth\AuthenticationController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/authentication/login', [\App\Http\Controllers\Web\Auth\AuthenticationController::class, 'authenticate'])->middleware('guest');
Route::get('/authentication/logout', [\App\Http\Controllers\Web\Auth\AuthenticationController::class, 'logout'])->name('backpack.auth.logout')->middleware('auth');
Route::post('/authentication/logout', [\App\Http\Controllers\Web\Auth\AuthenticationController::class, 'logout'])->middleware('auth');

// Registration Routes...
Route::get('/authentication/register', [\App\Http\Controllers\Web\Auth\RegisterController::class, 'showRegistrationForm'])->name('backpack.auth.register')->middleware('guest');
//Route::post('/dashboard/register', [\App\Http\Controllers\Web\Auth\RegisterController::class, 'register'])->middleware('guest');

Route::get('password/reset', [\App\Http\Controllers\Web\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('backpack.auth.password.reset');
Route::post('password/reset', [\App\Http\Controllers\Web\Auth\ForgotPasswordController::class, 'reset']);
Route::get('password/reset/{token}', [\App\Http\Controllers\Web\Auth\ResetPasswordController::class, 'showResetForm'])->name('backpack.auth.password.reset.token');
Route::post('password/email', [\App\Http\Controllers\Web\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('backpack.auth.password.email')->middleware('backpack.throttle.password.recovery:' . config('backpack.base.password_recovery_throttle_access'));


// Has to be verification.action because Laravel won't let me change it.
Route::get('email/verify', [\App\Http\Controllers\Web\Auth\VerifyEmailController::class, 'emailVerificationRequired'])->name('verification.notice')->middleware('guest');
Route::get('email/verify/{id}/{hash}', [\App\Http\Controllers\Web\Auth\VerifyEmailController::class, 'verifyEmail'])->name('verification.verify')->middleware('guest');
Route::post('email/verification-notification', [\App\Http\Controllers\Web\Auth\VerifyEmailController::class, 'resendVerificationEmail'])->name('verification.send')
  ->middleware('guest');

Route::get('/dashboard', [\App\Http\Controllers\Web\Dashboard\DashboardController::class, 'index'])->name('routes.web.dashboard.index')->can("dashboard.view");
Route::get('/authentication/discord/redirect', [\App\Http\Controllers\Web\Auth\AuthenticationController::class, 'discordRedirect'])->name('routes.authentication.discord.redirect');
Route::get('/authentication/discord/callback', [\App\Http\Controllers\Web\Auth\AuthenticationController::class, 'discordCallback'])->name('routes.authentication.discord.callback');

Route::get('/edit-account-info', [\App\Http\Controllers\Web\Auth\MyAccountController::class, 'getAccountInfoForm'])->name('backpack.account.info');
Route::post('/edit-account-info', [\App\Http\Controllers\Web\Auth\MyAccountController::class, 'postAccountInfoForm'])->name('backpack.account.info.store');
Route::post('/change-password', [\App\Http\Controllers\Web\Auth\MyAccountController::class, 'postChangePasswordForm'])->name('backpack.account.password');
