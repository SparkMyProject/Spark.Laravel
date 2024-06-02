<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class Calendar extends Controller
{
  public function calendar()
  {
    return view('content.dashboard.calendar');
  }
}
