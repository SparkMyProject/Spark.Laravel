<?php

namespace App\Http\Controllers\Web\DashboardOld;

use App\Http\Controllers\Web\Controller;

class HomePage extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'layoutFront'];
    return view('dashboard.index', [
      'title' => 'Test Page',
      'breadcrumbs' => [
        trans('backpack::crud.admin') => backpack_url('dashboard'),
        'TestPage' => false,
      ],
      'page' => 'resources/views/dashboard/index.blade.php',
      'controller' => 'app/Http/Controllers/Web/Dashboard/HomePage.php',
    ]);
  }
}
