<?php
Route::middleware([
  'auth:sanctum',
  config('jetstream.auth_session'),
  'verified',
])->group(function () {
  Route::get('/dashboard', [\App\Http\Controllers\Dashboard\HomePage::class, 'index'])->name('routes.web.dashboard.index')->middleware("canCustom:dashboard.view");
});

Route::get('/dashboard/calendar', [\App\Http\Controllers\Dashboard\Calendar::class, 'calendar'])->name('routes.web.dashboard.calendar')->middleware("canCustom:dashboard.calendar.view");
