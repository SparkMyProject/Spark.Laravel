<?php

// pages (without controller)
use Illuminate\Routing\Route;

Route::get('/misc/errors/not-authorized', function () {
  return view('misc.errors.not-authorized');
})->name('routes.misc.errors.not-authorized');

Route::get('/misc/errors/not-found', function () {
  return view('misc.errors.not-found');
})->name('routes.misc.errors.not-found');

Route::get('/misc/errors/acct-banned', function () {
  return view('misc.errors.acct-banned');
})->name('routes.misc.errors.acct-banned');
