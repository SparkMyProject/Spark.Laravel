<?php

namespace App\Http\Livewire\Dashboard;

use DateTime;
use Livewire\Component;

class CalendarComponent extends Component
{


  public function render()
  {
    $events = \App\Models\CalendarEvent::query()
      ->select('id', 'calendar_id', 'user_id', 'title', 'label', 'start_date AS start', 'end_date AS end', 'all_day AS allDay', 'url', 'description')
      ->get();


    return view('components.livewire.dashboard.calendar-component', ['events' => $events]);
  }
}
