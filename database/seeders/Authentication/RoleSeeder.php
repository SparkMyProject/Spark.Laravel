<?php

namespace Database\Seeders\Authentication;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
  public function run(): void
  {
    //
    $user = \Spatie\Permission\Models\Role::create(['name' => 'User', 'description' => 'User', 'priority' => 1, 'is_system' => true]);
    $webmaster = \Spatie\Permission\Models\Role::create(['name' => 'Webmaster', 'description' => 'Webmaster', 'priority' => 100, 'is_system' => true]);
    $test_no_system = \Spatie\Permission\Models\Role::create(['name' => 'Test No System', 'description' => 'Test No System', 'priority' => 50, 'is_system' => false]);
  }
}
