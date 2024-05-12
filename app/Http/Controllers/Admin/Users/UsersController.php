<?php

namespace App\Http\Controllers\Admin\Users;

use App\Helpers\ModelHelper;
use App\Helpers\PermissionsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
  public function index()
  {
    return view('content.admin.users.index');
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

    if ($current_user->can('actions.admin.users.disable')) {
      if ($current_user->roles->sortByDesc('priority')->first()->priority > $user->roles->sortByDesc('priority')->first()->priority) {
        $user->update(['account_status' => 'Disabled']);
        $response = ["message" => "success", "code" => 200];
      } else {
        $response = ["message" => "insufficient_permissions", "code" => 403];
      }
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

    if ($current_user->can('actions.admin.users.disable')) {
      if ($current_user->roles->sortByDesc('priority')->first()->priority > $user->roles->sortByDesc('priority')->first()->priority) {
        $user->update(['account_status' => 'Active']);
        $response = ["message" => "success", "code" => 200];
      } else {
        $response = ["message" => "insufficient_permissions", "code" => 403];
      }
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
        'account_status' => 'nullable|string|max:30',
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
    return view('content.admin.users.view', ['user' => $user]);
  }
}
