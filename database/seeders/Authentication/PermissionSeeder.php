<?php

namespace Database\Seeders\Authentication;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $dashboardPermission = \Spatie\Permission\Models\Permission::create(['name' => 'view content.dashboard.index']);
    $userRole = Role::findByName('User');
    $userRole->givePermissionTo($dashboardPermission);
  }
}
