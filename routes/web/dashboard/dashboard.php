<?php
Route::middleware([
  'auth:sanctum',
  config('jetstream.auth_session'),
  'verified',
])->group(function () {
  Route::get('/dashboard', [\App\Http\Controllers\Dashboard\HomePage::class, 'index'])->name('routes.content.dashboard.index')->middleware("canCustom:dashboard.view");
});

Route::get('/dashboard/calendar', [\App\Http\Controllers\Dashboard\Calendar::class, 'calendar'])->name('routes.content.dashboard.calendar')->middleware("canCustom:dashboard.calendar.view");
