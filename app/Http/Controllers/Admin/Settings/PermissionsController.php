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

  public function edit($id)
  {
    $permission = Permission::find($id);
    if (!$permission) {
      session()->flash('error', 'Permission not found');
      return redirect()->route('routes.content.admin.settings.permissions.index');
    }

    $validated = request()->validate([
      'name' => 'nullable|string|max:30',
      'description' => 'nullable|string|max:30'
    ]);

    $permission->update(array_filter($validated));
    session()->flash('success', 'Permission updated');

    return redirect()->route('routes.content.admin.settings.permissions.index');
  }
}
