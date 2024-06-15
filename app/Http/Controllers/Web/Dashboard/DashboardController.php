<?php

namespace App\Http\Controllers\Web\Dashboard;

use Illuminate\Routing\Controller;

class DashboardController extends Controller
{

  public function index()
  {
    return view('dashboard.index');
  }
}
