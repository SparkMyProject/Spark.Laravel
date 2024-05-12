<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{
  public function index()
  {
    $permissions = Permission::withCount(['roles', 'users'])->get();
    return view('content.admin.settings.permissions.index', ['permissions' => $permissions]);
  }
}
