<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{
  public function index()
  {
    $permissions = Permission::all();
    return view('content.admin.settings.permissions.index', ['permissions' => $permissions]);
  }
}
