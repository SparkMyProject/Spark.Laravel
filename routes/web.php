<?php

use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\Page2;
use App\Http\Controllers\Web\FrontPages\FrontPages;
use App\Http\Controllers\Web\language\LanguageController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [FrontPages::class, 'index'])->name('routes.web.pages.landing-page');

Route::get('/exception', function () {
  throw new Exception('This is a test exception.');
});

// locale
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

