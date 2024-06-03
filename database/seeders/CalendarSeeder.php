<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Calendar;
use Illuminate\Database\Seeder;

class CalendarSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $calendar = Calendar::create([
      'name' => 'My Calendar',
    ]);

    $calendar->events()->create([
      'title' => 'My Event',
      'label' => 'My Label',
      'start_date' => now(),
      'end_date' => now()->addHour(),
      'all_day' => false,
      'url' => 'https://example.com',
      'description' => 'My Description',
      'user_id' => 1,
    ]);
  }
}
