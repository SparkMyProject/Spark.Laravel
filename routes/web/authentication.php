<?php

// Authentication Routes, overriding Jetstream routes
use Illuminate\Support\Facades\Route;

Route::get('/authentication/login', [\App\Http\Controllers\Web\Authentication\AuthenticationController::class, 'showLoginForm'])->name('routes.authentication.login');
Route::post('/authentication/login', [\App\Http\Controllers\Web\Authentication\AuthenticationController::class, 'authenticate']);
Route::post('/authentication/logout', [\App\Http\Controllers\Web\Authentication\AuthenticationController::class, 'logout'])->name('routes.authentication.logout');

Route::get('/authentication/register', [\App\Http\Controllers\Web\Authentication\AuthenticationController::class, 'showRegisterForm'])->name('routes.authentication.register');




Route::get('/authentication/discord/redirect', [\App\Http\Controllers\Web\Authentication\AuthenticationController::class, 'discordRedirect'])->name('routes.authentication.discord.redirect');
Route::get('/authentication/discord/callback', [\App\Http\Controllers\Web\Authentication\AuthenticationController::class, 'discordCallback'])->name('routes.authentication.discord.callback');

// Email Verification Routes
Route::get('/authentication/email/verify', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
  $request->fulfill();
  return redirect()->route('routes.web.dashboard.index');
})->middleware(['auth', 'signed'])->name('routes.web.authentication.email.verify');
