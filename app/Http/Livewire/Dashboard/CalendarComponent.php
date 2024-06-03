<?php

namespace App\Http\Livewire\Dashboard;

use Carbon\Carbon;
use DateTime;
use Livewire\Component;

class CalendarComponent extends Component
{


  public function render()
  {
    $events = \App\Models\CalendarEvent::query()
      ->select('id', 'calendar_id', 'user_id', 'title', 'label', 'start_date AS start', 'end_date AS end', 'all_day AS allDay', 'url', 'description')
      ->get();

    $events->transform(function ($event) {
      $event->start = Carbon::parse($event->start)->inUserTimezone();
      $event->end = Carbon::parse($event->end)->inUserTimezone();
      return $event;
    });
    return view('components.livewire.dashboard.calendar-component', ['events' => $events]);
  }
}
