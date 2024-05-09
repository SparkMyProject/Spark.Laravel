<?php

namespace Database\Seeders\Authentication;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AuthenticationSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
//    \App\Models\Authentication\User::factory(10)->create();


    $admin = \App\Models\Authentication\User::factory()->create([
      'username' => 'admin',
      'password' => Hash::make('Admin123!'),
    ]);

//    $adminRole = Role::create(['name' => 'admin']);
//    $admin->assignRole($adminRole);
//    $permission = \Spatie\Permission\Models\Permission::create(['name' => 'view content.dashboard.index']);
//    $adminRole->givePermissionTo($permission);

    $webmasterRole = Role::findByName('Webmaster');
    $admin->assignRole($webmasterRole);
  }
}
