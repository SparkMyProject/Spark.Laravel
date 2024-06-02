<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Barryvdh\Debugbar\Facades\Debugbar;

class Calendar extends Controller
{
  public function calendar()
  {
    $events = \App\Models\CalendarEvent::all();
    Debugbar::info($events);
    return view('content.dashboard.calendar', compact('events'));
  }
}
