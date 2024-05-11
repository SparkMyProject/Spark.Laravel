<?php

namespace App\Http\Controllers\Admin\Users;

use App\Helpers\PermissionsHelper;
use App\Helpers\ModelHelper;
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


  public function edit_user() {
    $user = \App\Models\Authentication\User::find(request('userId'));
    $current_user = Auth::user()->load('roles');

    if ($user == null) {
      session()->flash('error', 'User not found.');
    }
    if ($current_user->cannot('actions.admin.users.edit') || !PermissionsHelper::highestRoleCompare($current_user, $user)) {
      session()->flash('error', 'User does not have permission.');
    } else {
      $fields = ['username', 'display_name', 'email', 'timezone', 'account_status', 'first_name', 'last_name'];
      $user = ModelHelper::updateModel($fields, $user, request()->all());
      $user->save();
    }
    session()->flash('success', 'User updated successfully.');
    return view('content.admin.users.index');
  }
}
