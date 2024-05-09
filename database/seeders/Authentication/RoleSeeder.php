<?php

namespace Database\Seeders\Authentication;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
  public function run(): void
  {
    //
    $user = \Spatie\Permission\Models\Role::create(['name' => 'User']);
    $webmaster = \Spatie\Permission\Models\Role::create(['name' => 'Webmaster']);
  }
}
