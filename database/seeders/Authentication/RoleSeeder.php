<?php

namespace Database\Seeders\Authentication;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
  public function run(): void
  {
    //
    $user = \Spatie\Permission\Models\Role::create(['name' => 'User', 'description' => 'User', 'priority' => 1]);
    $webmaster = \Spatie\Permission\Models\Role::create(['name' => 'Webmaster', 'description' => 'Webmaster', 'priority' => 100]);
  }
}
