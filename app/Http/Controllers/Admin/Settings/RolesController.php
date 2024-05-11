<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Routing\Controller;

class RolesController extends Controller
{
  public function index()
    {
        return view('content.admin.settings.roles');
    }
}
