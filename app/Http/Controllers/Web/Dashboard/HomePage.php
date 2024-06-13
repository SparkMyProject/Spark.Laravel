<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Web\Controller;

class HomePage extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'layoutFront'];
    return view('web.dashboard.index', ['pageConfigs' => $pageConfigs]);
  }
}
