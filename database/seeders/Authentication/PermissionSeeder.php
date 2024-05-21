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
    $dashboardPermission = Permission::create(['name' => 'dashboard.view', 'description' => 'View the dashboard', 'is_system' => true]);

    // Admin/Users
    Permission::create(['name' => 'admin.users.view', 'description' => 'View users', 'is_system' => true]);
    Permission::create(['name' => 'admin.users.edit', 'description' => 'Edit users', 'is_system' => true]);
    Permission::create(['name' => 'admin.users.disable', 'description' => 'Disable users', 'is_system' => true]);
    Permission::create(['name' => 'admin.users.enable', 'description' => 'Enable users', 'is_system' => true]);
    Permission::create(['name' => 'admin.users.edit-roles', 'description' => 'Edit user roles', 'is_system' => true]);

    // Admin/Settings/AuditLog
    Permission::create(['name' => 'admin.settings.auditlog.view', 'description' => 'View audit log', 'is_system' => true]);

    // Admin/Settings/Roles
    Permission::create(['name' => 'admin.settings.roles.view', 'description' => 'View roles', 'is_system' => true]);
    Permission::create(['name' => 'admin.settings.roles.edit', 'description' => 'Edit roles', 'is_system' => true]);
    Permission::create(['name' => 'admin.settings.roles.edit-permissions', 'description' => 'Edit role permissions', 'is_system' => true]);
    Permission::create(['name' => 'admin.settings.roles.delete', 'description' => 'Delete roles', 'is_system' => true]);
    Permission::create(['name' => 'admin.settings.roles.create', 'description' => 'Create roles', 'is_system' => true]);

    // Admin/Settings/Permissions
    Permission::create(['name' => 'admin.settings.permissions.view', 'description' => 'View permissions', 'is_system' => true]);
    Permission::create(['name' => 'admin.settings.permissions.edit', 'description' => 'Edit permissions', 'is_system' => true]);



    $userRole = Role::findByName('User');
    $userRole->givePermissionTo($dashboardPermission);
  }
}
