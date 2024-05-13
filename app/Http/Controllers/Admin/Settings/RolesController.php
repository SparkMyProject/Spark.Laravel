<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
  public function index()
  {
    $roles = Role::withCount('users')->withCount('permissions')->orderBy('name')->get();
    $permissions = Permission::orderBy('name')->get();
    return view('content.admin.settings.roles.index', ['roles' => $roles, 'permissions' => $permissions]);
  }

  public function edit($id)
  {
    $role = Role::find($id);
    if (!$role) {
      session()->flash('error', 'Role not found.');
      return redirect()->route('routes.content.admin.settings.roles.index');
    }
    if ($role->name == 'User') {
      session()->flash('error', 'Cannot edit the User role.');
      return redirect()->route('routes.content.admin.settings.roles.index');
    }
    if ($role->name == 'Webmaster') {
      session()->flash('error', 'Cannot edit the Webmaster role.');
      return redirect()->route('routes.content.admin.settings.roles.index');
    }
    $validated = request()->validate([
      'name' => 'nullable|string|max:20',
      'description' => 'nullable|string|max:30',
      'icon' => 'nullable|string|max:30',
      'priority' => 'nullable|integer',
    ]);

    $role->update(array_filter($validated));
    session()->flash('success', 'Role updated.');
    return redirect()->route('routes.content.admin.settings.roles.index');
  }

  public function edit_permissions($id)
  {
    $role = Role::find($id);
    if (!$role) {
      session()->flash('error', 'Role not found.');
      return redirect()->route('routes.content.admin.settings.roles.index');
    }
    if ($role->name == 'Webmaster') {
      session()->flash('error', 'Cannot edit the Webmaster role.');
      return redirect()->route('routes.content.admin.settings.roles.index');
    }
    $validated = request()->validate([
      'permissions' => 'nullable|array',
    ]);

    // Use the get method to avoid "Undefined array key" errors
    $permissions = $validated['permissions'] ?? [];

    $role->syncPermissions($permissions);
    session()->flash('success', 'Role permissions updated.');
    return redirect()->route('routes.content.admin.settings.roles.index');
  }
}
