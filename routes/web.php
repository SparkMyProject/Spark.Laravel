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

