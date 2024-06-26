<?php
// Admin/Users
use Illuminate\Support\Facades\Route;

Route::get('/admin/users/view/{id}', [\App\Http\Controllers\Web\Admin\Users\UsersController::class, 'view_user'])->name('routes.web.admin.users.view')->middleware("canCustom:admin.users.view");

Route::get('/admin/users', [\App\Http\Controllers\Web\Admin\Users\UsersController::class, 'index'])->name('routes.web.admin.users.index')->middleware("canCustom:admin.users.view");
Route::post('/admin/users/disable', [\App\Http\Controllers\Web\Admin\Users\UsersController::class, 'disable_user'])->name('routes.web.admin.users.disable')->middleware("canCustom:admin.users.disable");
Route::post('/admin/users/enable', [\App\Http\Controllers\Web\Admin\Users\UsersController::class, 'enable_user'])->name('routes.web.admin.users.enable')->middleware("canCustom:admin.users.enable");
Route::post('/admin/users/edit', [\App\Http\Controllers\Web\Admin\Users\UsersController::class, 'edit_user'])->name('routes.web.admin.users.edit')->middleware("canCustom:admin.users.edit");
Route::post('/admin/users/edit-roles/{id}', [\App\Http\Controllers\Web\Admin\Users\UsersController::class, 'edit_roles'])->name('routes.web.admin.users.edit-roles')->middleware("canCustom:admin.users.edit-roles");

Route::post('/admin/users/reset-password', [\App\Http\Controllers\Web\Admin\Users\UsersController::class, 'reset_password'])->name('routes.web.admin.users.reset-password')->middleware("canCustom:admin.users.reset-password");
