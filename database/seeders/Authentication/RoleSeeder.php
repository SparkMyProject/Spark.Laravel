<?php

namespace Database\Seeders\Authentication;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
  public function run(): void
  {
    //
    $webmaster = \Spatie\Permission\Models\Role::create(['name' => 'Webmaster']);
  }
}
