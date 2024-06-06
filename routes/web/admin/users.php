<?php
// Admin/Users
use Illuminate\Support\Facades\Route;

Route::get('/admin/users/view/{id}', [\App\Http\Controllers\Admin\Users\UsersController::class, 'view_user'])->name('routes.web.admin.users.view')->can("admin.users.view");

Route::get('/admin/users', [\App\Http\Controllers\Admin\Users\UsersController::class, 'index'])->name('routes.web.admin.users.index')->can("admin.users.view");
Route::post('/admin/users/disable', [\App\Http\Controllers\Admin\Users\UsersController::class, 'disable_user'])->name('routes.web.admin.users.disable')->can("admin.users.disable");
Route::post('/admin/users/enable', [\App\Http\Controllers\Admin\Users\UsersController::class, 'enable_user'])->name('routes.web.admin.users.enable')->can("actions.admin.users.enable");
Route::post('/admin/users/edit', [\App\Http\Controllers\Admin\Users\UsersController::class, 'edit_user'])->name('routes.web.admin.users.edit')->can("admin.users.edit");
Route::post('/admin/users/edit-roles/{id}', [\App\Http\Controllers\Admin\Users\UsersController::class, 'edit_roles'])->name('routes.web.admin.users.edit-roles')->can("admin.settings.users.edit-roles");
