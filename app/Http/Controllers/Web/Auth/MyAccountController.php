<?php

namespace App\Http\Controllers\Web\Auth;

use Backpack\CRUD\app\Http\Requests\AccountInfoRequest;
use Backpack\CRUD\app\Http\Requests\ChangePasswordRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Prologue\Alerts\Facades\Alert;

class MyAccountController extends Controller
{
  protected $data = [];

  public function __construct()
  {
    $this->middleware(backpack_middleware());
  }

  /**
   * Show the user a form to change their personal information & password.
   *
   * @return \Illuminate\Contracts\View\View
   */
  public function getAccountInfoForm()
  {
    $this->data['title'] = trans('backpack::base.my_account');
    $this->data['user'] = $this->guard()->user();

    return view(backpack_view('my_account'), $this->data);
  }

  /**
   * Save the modified personal information for a user.
   */
  public function postAccountInfoForm(AccountInfoRequest $request)
  {
    throw new \Exception("This is a test exception.");
    // Get validation status for whichever authentication_column is an email.
    $emailColumn = "";
    $emailValidation = "";
    if (backpack_authentication_column() == "email") {
      $emailColumn = "email";
      $emailValidation = backpack_authentication_validation();
    } else if (backpack_authentication_secondary_enabled() && backpack_authentication_secondary_column() == "email") {
      $emailColumn = backpack_authentication_secondary_column();
      $emailValidation = backpack_authentication_secondary_validation();
    }

    $request->validate([
      $emailColumn => $emailValidation,
      'first_name' => 'nullable|string|max:128',
      'last_name' => 'nullable|string|max:128',
      'display_name' => 'nullable|string|max:30',
      'status' => 'nullable|string|max:30',
    ]);
    $result = $this->guard()->user()->update($request->validated());

    if ($result) {
      Alert::success(trans('backpack::base.account_updated'))->flash();
    } else {
      Alert::error(trans('backpack::base.error_saving'))->flash();
    }

    return redirect()->back();
  }

  /**
   * Save the new password for a user.
   */
  public function postChangePasswordForm(ChangePasswordRequest $request)
  {
    $user = $this->guard()->user();
    $user->password = Hash::make($request->new_password);

    if ($user->save()) {
      Alert::success(trans('backpack::base.account_updated'))->flash();
    } else {
      Alert::error(trans('backpack::base.error_saving'))->flash();
    }

    // If the AuthenticateSessions middleware is being used
    // the password hash should be updated, in order to
    // invalidate all authenticated browser sessions
    // except for the current one.
    $this->guard()->logoutOtherDevices($request->new_password);

    // If the AuthenticateSession middleware was used until now,
    // also update the password hash in the session so that the
    // admin does not get logged out in the next request.
    if ($request->session()->has('password_hash_' . backpack_guard_name())) {
      $request->session()->put([
        'password_hash_' . backpack_guard_name() => $user->getAuthPassword(),
      ]);
    }

    return redirect()->back();
  }

  /**
   * Get the guard to be used for account manipulation.
   *
   * @return \Illuminate\Contracts\Auth\StatefulGuard
   */
  protected function guard()
  {
    return backpack_auth();
  }
}
