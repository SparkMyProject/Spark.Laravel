<?php

namespace Database\Seeders\Authentication;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $dashboardPermission = Permission::create(['name' => 'actions.dashboard.index.view', 'description' => 'View the dashboard']);
    Permission::create(['name' => 'actions.admin.users.view', 'description' => 'View users']);
    Permission::create(['name' => 'actions.admin.users.edit', 'description' => 'Edit users']);
    Permission::create(['name' => 'actions.admin.users.disable', 'description' => 'Disable users']);
    Permission::create(['name' => 'actions.admin.users.enable', 'description' => 'Enable users']);
    Permission::create(['name' => 'actions.admin.settings.auditlog.view', 'description' => 'View audit log']);
    Permission::create(['name' => 'actions.admin.settings.roles.view', 'description' => 'View roles']);
    Permission::create(['name' => 'actions.admin.settings.roles.edit', 'description' => 'Edit roles']);
    Permission::create(['name' => 'actions.admin.settings.roles.edit-permissions', 'description' => 'Edit role permissions']);
    Permission::create(['name' => 'actions.admin.settings.permissions.view', 'description' => 'View permissions']);
    Permission::create(['name' => 'actions.admin.settings.permissions.edit', 'description' => 'Edit permissions']);


    $userRole = Role::findByName('User');
    $userRole->givePermissionTo($dashboardPermission);
  }
}
