<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class HomePage extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'layoutFront'];
    return view('content.dashboard.index', ['pageConfigs' => $pageConfigs]);
  }
}