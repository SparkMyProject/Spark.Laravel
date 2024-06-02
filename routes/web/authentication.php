<?php

// Authentication Routes, overriding Jetstream routes
use App\Models\Authentication\OAuthUser;
use App\Models\Authentication\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

Route::get('/authentication/login', [\App\Http\Controllers\Authentication\AuthenticationController::class, 'showLoginForm'])->name('routes.authentication.login');
Route::post('/authentication/login', [\App\Http\Controllers\Authentication\AuthenticationController::class, 'authenticate']);
Route::post('/authentication/logout', [\App\Http\Controllers\Authentication\AuthenticationController::class, 'logout'])->name('routes.authentication.logout');

Route::get('/authentication/register', [\App\Http\Controllers\Authentication\AuthenticationController::class, 'showRegisterForm'])->name('routes.authentication.register');




Route::get('/authentication/discord/redirect', [\App\Http\Controllers\Authentication\AuthenticationController::class, 'discordRedirect'])->name('routes.authentication.discord.redirect');
Route::get('/authentication/discord/callback', [\App\Http\Controllers\Authentication\AuthenticationController::class, 'discordCallback'])->name('routes.authentication.discord.callback');
