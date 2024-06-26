<?php

// Authentication Routes, overriding Jetstream routes
use Illuminate\Support\Facades\Route;

Route::get('/auth/login', [\App\Http\Controllers\Web\Authentication\AuthenticationController::class, 'showLoginForm'])->name('routes.web.auth.login');
Route::post('/auth/login', [\App\Http\Controllers\Web\Authentication\AuthenticationController::class, 'authenticate']);
Route::post('/auth/logout', [\App\Http\Controllers\Web\Authentication\AuthenticationController::class, 'logout'])->name('routes.web.auth.logout');

Route::get('/auth/register', [\App\Http\Controllers\Web\Authentication\AuthenticationController::class, 'showRegisterForm'])->name('routes.web.auth.register');




Route::get('/auth/discord/redirect', [\App\Http\Controllers\Web\Authentication\AuthenticationController::class, 'discordRedirect'])->name('routes.web.auth.discord.redirect');
Route::get('/auth/discord/callback', [\App\Http\Controllers\Web\Authentication\AuthenticationController::class, 'discordCallback'])->name('routes.web.auth.discord.callback');

// Email Verification Routes
Route::get('/auth/email/verify', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
  $request->fulfill();
  return redirect()->route('routes.web.dashboard.index');
})->middleware(['auth', 'signed'])->name('routes.web.auth.email.verify');
