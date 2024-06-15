<?php

// Authentication Routes, overriding Jetstream routes
use Illuminate\Support\Facades\Route;


// Authentication Routes...
Route::get('/dashboard/login', [\App\Http\Controllers\Web\Auth\LoginController::class, 'showLoginForm'])->name('backpack.auth.login');
Route::post('/dashboard/login', [\App\Http\Controllers\Web\Auth\LoginController::class, 'login']);
Route::get('/dashboard/logout', [\App\Http\Controllers\Web\Auth\LoginController::class, 'logout'])->name('backpack.auth.logout');
Route::post('/dashboard/logout', [\App\Http\Controllers\Web\Auth\LoginController::class, 'logout']);

// Registration Routes...
Route::get('/dashboard/register', [\App\Http\Controllers\Web\Auth\RegisterController::class, 'showRegistrationForm'])->name('backpack.auth.register');
Route::post('/dashboard/register', [\App\Http\Controllers\Web\Auth\RegisterController::class, 'register']);

Route::get('password/reset', [\App\Http\Controllers\Web\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('backpack.auth.password.reset');
Route::post('password/reset', [\App\Http\Controllers\Web\Auth\ForgotPasswordController::class, 'reset']);
Route::get('password/reset/{token}', [\App\Http\Controllers\Web\Auth\ResetPasswordController::class, 'showResetForm'])->name('backpack.auth.password.reset.token');
Route::post('password/email', [\App\Http\Controllers\Web\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('backpack.auth.password.email')->middleware('backpack.throttle.password.recovery:' . config('backpack.base.password_recovery_throttle_access'));

Route::get('email/verify', [\App\Http\Controllers\Web\Auth\VerifyEmailController::class, 'emailVerificationRequired'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [\App\Http\Controllers\Web\Auth\VerifyEmailController::class, 'verifyEmail'])->name('verification.verify');
Route::post('email/verification-notification', [\App\Http\Controllers\Web\Auth\VerifyEmailController::class, 'resendVerificationEmail'])->name('verification.send');

Route::get('/dashboard', [\App\Http\Controllers\Web\Dashboard\DashboardController::class, 'index'])->name('routes.web.dashboard.index')->middleware(['auth', 'verified']);
Route::get('/authentication/discord/redirect', [\App\Http\Controllers\Web\Authentication\AuthenticationController::class, 'discordRedirect'])->name('routes.authentication.discord.redirect');
Route::get('/authentication/discord/callback', [\App\Http\Controllers\Web\Authentication\AuthenticationController::class, 'discordCallback'])->name('routes.authentication.discord.callback');
