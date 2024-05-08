<?php

namespace Database\Seeders\Authentication;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AuthenticationSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
//    \App\Models\Authentication\User::factory(10)->create();

    \App\Models\Authentication\User::factory()->create([
      'username' => 'Test User',
      'email' => 'test@example.com',
    ]);
    \App\Models\Authentication\User::factory()->create([
      'username' => 'admin',
      'password' => Hash::make('Admin123!'),
    ]);
  }
}
