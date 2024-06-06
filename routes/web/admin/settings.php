<?php
// Admin/Settings
use Illuminate\Support\Facades\Route;

Route::get('/admin/settings/auditlog', [\App\Http\Controllers\Admin\Settings\AuditLogController::class, 'index'])->name('routes.web.admin.settings.auditlog.index')->can("admin.settings.auditlog.view");
Route::get('/admin/settings/auditlog/view/{id}', [\App\Http\Controllers\Admin\Settings\AuditLogController::class, 'view'])->name('routes.web.admin.settings.auditlog.view')
  ->can("admin.settings.auditlog.view");

Route::get('/admin/settings/roles', [\App\Http\Controllers\Admin\Settings\RolesController::class, 'index'])->name('routes.web.admin.settings.roles.index')->can("admin.settings.roles.view");
Route::post('/admin/settings/roles/edit/{id}', [\App\Http\Controllers\Admin\Settings\RolesController::class, 'edit'])->name('routes.web.admin.settings.roles.edit')->can("admin.settings.roles.edit");
Route::post('/admin/settings/roles/delete/{id}', [\App\Http\Controllers\Admin\Settings\RolesController::class, 'delete'])->name('routes.web.admin.settings.roles.delete')->can("admin.settings.roles.delete");
Route::post('/admin/settings/roles/create', [\App\Http\Controllers\Admin\Settings\RolesController::class, 'create'])->name('routes.web.admin.settings.roles.create')->can("admin.settings.roles.create");
Route::post('admin/settings/roles/edit-permissions/{id}', [\App\Http\Controllers\Admin\Settings\RolesController::class, 'edit_permissions'])->name('routes.web.admin.settings.roles.edit-permissions')->can("admin.settings.roles.edit-permissions");


Route::get('/admin/settings/permissions', [\App\Http\Controllers\Admin\Settings\PermissionsController::class, 'index'])->name('routes.web.admin.settings.permissions.index')->can("admin.settings.permissions.view");
Route::post('/admin/settings/permissions/edit/{id}', [\App\Http\Controllers\Admin\Settings\PermissionsController::class, 'edit'])->name('routes.web.admin.settings.permissions.edit')->can("admin.settings.permissions.edit");
Route::get('/admin/settings/permissions/view/{id}', [\App\Http\Controllers\Admin\Settings\PermissionsController::class, 'view'])->name('routes.web.admin.settings.permissions.view')->can("admin.settings.permissions.view");
