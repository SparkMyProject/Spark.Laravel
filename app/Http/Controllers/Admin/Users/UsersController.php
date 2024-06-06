<?php

namespace App\Http\Controllers\Admin\Users;

use App\Helpers\PermissionsHelper;
use App\Http\Controllers\Controller;
use App\Models\Authentication\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
  public function index()
  {
    $users = User::with(['roles' => function ($query) {
      $query->orderBy('priority', 'desc');
    }])->with("oauthUser")->get();
    $roles = Role::orderBy('priority', 'desc')->get();
    return view('web.admin.users.index', ['users' => $users, 'roles' => $roles]);
  }

  public function disable_user()
  {
    $user = \App\Models\Authentication\User::find(request('userId'));
    $current_user = auth()->user();
    $response = ["message" => "error"];

    if ($user == null) {
      $response = ["message" => "user_not_found", "code" => 404];
    } else if ($user->account_status == 'Disabled') {
      $response = ["message" => "already_disabled", "code" => 400];
    } else if ($user->account_status == "Banned") {
      $response = ["message" => "already_banned", "code" => 400];
    }

    if (PermissionsHelper::highestRoleCompare($current_user, $user)) {
      $user->update(['account_status' => 'Disabled']);
      $response = ["message" => "success", "code" => 200];
    } else {
      $response = ["message" => "insufficient_permissions", "code" => 403];
    }
    return response()->json($response);
  }

  public function enable_user()
  {
    $user = \App\Models\Authentication\User::find(request('userId'));
    $current_user = auth()->user();
    $response = ["message" => "error"];

    if ($user == null) {
      $response = ["message" => "user_not_found", "code" => 404];
    } else if ($user->account_status == 'Enabled') {
      $response = ["message" => "already_enabled", "code" => 400];
    } else if ($user->account_status == "Banned") {
      $response = ["message" => "already_banned", "code" => 400];
    }

    if (PermissionsHelper::highestRoleCompare($current_user, $user)) {
      $user->update(['account_status' => 'Disabled']);
      $response = ["message" => "success", "code" => 200];
    } else {
      $response = ["message" => "insufficient_permissions", "code" => 403];
    }
    return response()->json($response);
  }


  public function edit_user()
  {
    $user = \App\Models\Authentication\User::find(request('userId'));
    $current_user = Auth::user()->load('roles');

    if ($user == null) {
      session()->flash('error', 'User not found.');
    }
    if (!PermissionsHelper::highestRoleCompare($current_user, $user)) {
      session()->flash('error', 'User does not have permission or is trying to edit themselves.');
    } else {
      $validated = request()->validate([
        'username' => 'nullable|string|max:20',
        'display_name' => 'nullable|string|max:20',
        'email' => 'nullable|email',
        'timezone' => 'nullable|string|max:30',
        'account_status' => 'nullable|string|max:30|in:Active,On Hold,Disabled,Banned',
        'first_name' => 'nullable|string|max:30',
        'last_name' => 'nullable|string|max:30',
      ]);
      $user->update(array_filter($validated));
      session()->flash('success', 'User updated successfully.');
    }
    // refresh current page
    return redirect()->back();
  }

  public function view_user($id)
  {
    // Route is protected by the permission
    $user = \App\Models\Authentication\User::find($id);
    $current_user = Auth::user()->load('roles');

    if ($user == null) {
      session()->flash('error', 'User not found.');
      return view('content.admin.users.index');
    }

    $user->load(['roles' => function ($query) {
      $query->orderBy('priority', 'desc');
    }]);
    $user->load('timeline');
    return view('web.admin.users.view', ['user' => $user]);
  }

  public function edit_roles($id)
  {
    $user = \App\Models\Authentication\User::find($id);
    $current_user = Auth::user()->load('roles');

    // Check if user exists
    if ($user == null) {
      session()->flash('error', 'User not found.');
      return redirect()->back();
    }

    // Check if user is trying to edit themselves or if user is trying to edit a user with higher role
    if (!PermissionsHelper::highestRoleCompare($current_user, $user)) {
      session()->flash('error', 'User does not have permission or is trying to edit themselves.');
      return redirect()->back();
    }

    $validated = request()->validate([
      'roles' => 'required|array', // Required because there needs to be at least one role
    ]);


    // Make sure the user and webmaster roles were not removed
    $newRoles = array_map('intval', $validated['roles']);
    $currentRoles = $user->roles->pluck('id')->toArray();

    $systemRoles = Role::where('is_system', true)->get()->pluck('id')->toArray();
    $systemUserCurrentRoles = array_intersect($currentRoles, $systemRoles);
    $systemUserNewRoles = array_intersect($newRoles, $systemRoles);

    // Check if user is trying to add/remove system roles
    // If current system roles are MORE than the new system roles, OR if the new system roles are MORE than the current system roles (remove/add)
    if (count(array_diff($systemUserCurrentRoles, $systemUserNewRoles)) > 0 || count(array_diff($systemUserNewRoles, $systemUserCurrentRoles)) > 0) {
      session()->flash('error', 'Cannot add/remove system roles.');
      return redirect()->back();
    }

    // Check if any changes were not made
    if (count(array_diff($currentRoles, $newRoles)) == 0 && count(array_diff($newRoles, $currentRoles)) == 0) {
      session()->flash('warning', 'No changes were made.');
    } else {
      $user->syncRoles($newRoles);
      session()->flash('success', 'User roles updated successfully.');
    }
    // refresh current page
    return redirect()->back();
  }
}
