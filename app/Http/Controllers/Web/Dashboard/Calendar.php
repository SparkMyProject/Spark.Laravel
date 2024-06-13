<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Web\Controller;
use Barryvdh\Debugbar\Facades\Debugbar;

class Calendar extends Controller
{
  public function calendar()
  {
    $events = \App\Models\CalendarEvent::all();
    Debugbar::info($events);
    return view('web.dashboard.calendar', compact('events'));
  }
}
