<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;

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

  public function view($id)
  {
    $permission = Permission::with([
      'roles' => function ($query) {
        $query->withCount('users'); // Getting the count of users with the role for the permission
      },
      'users' => function ($query) {
        $query->with(['roles' => function ($query) { // Getting the roles of the users with the permission
          $query->orderBy('priority', 'desc'); // Ordering the roles by priority
        }]);
      }
    ])->withCount(['roles', 'users'])->find($id); // Getting the count of roles and users with the permission

    if (!$permission) {
      session()->flash('error', 'Permission not found');
      return redirect()->route('routes.content.admin.settings.permissions.index');
    }

    return view('content.admin.settings.permissions.view', ['permission' => $permission]);
  }
}
