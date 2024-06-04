<?php

namespace App\Http\Livewire\Dashboard;

use Carbon\Carbon;
use Livewire\Component;

class CalendarComponent extends Component
{
  public $events;
  public $displayedEvents;

//  public function mount($events)
//  {
//    $this->events = $events;
//  }

  public function mount()
  {

    $this->events = \App\Models\CalendarEvent::query()
      ->select('id', 'calendar_id', 'user_id', 'title', 'label', 'start_date AS start', 'end_date AS end', 'all_day AS allDay', 'url', 'description')
      ->get();

    $this->events->transform(function ($event) {
      $event->start = Carbon::parse($event->start)->inUserTimezone();
      $event->end = Carbon::parse($event->end)->inUserTimezone();
      return $event;
    });

    $this->displayedEvents = $this->events;

  }

  public function render()
  {
    return view('components.livewire.dashboard.calendar-component', ['events' => $this->displayedEvents]);
  }

  public function testEvent()
  {
    dd('create_event');
  }
}
