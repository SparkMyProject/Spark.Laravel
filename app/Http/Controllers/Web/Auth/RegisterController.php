<?php

namespace App\Http\Controllers\Web\Auth;

use App\Actions\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
  protected ?string $redirectTo = null;

  protected $data = []; // the information we send to the view

  /*
  |--------------------------------------------------------------------------
  | Register Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users as well as their
  | validation and creation. By default this controller uses a trait to
  | provide this functionality without requiring any additional code.
  |
  */
  use RegistersUsers;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $guard = backpack_guard_name();

    $this->middleware("guest:$guard");

    // Where to redirect users after login / registration.
    $this->redirectTo ??= config('backpack.base.route_prefix', 'dashboard');
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param array $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
    $user_model_fqn = config('backpack.base.user_model_fqn');
    $user = new $user_model_fqn();
    $users_table = $user->getTable();

    // If primary and secondary are needed
    if ((backpack_authentication_column() == 'username' && backpack_authentication_secondary_column() == 'email') || (backpack_authentication_column() == 'email' &&
        backpack_authentication_secondary_column() == 'username')) {
      return Validator::make($data, [
        'name' => 'required|max:255',
        backpack_authentication_column() => backpack_authentication_validation(),
        backpack_authentication_secondary_column() => backpack_authentication_secondary_validation(),
        'password' => 'required|min:6|confirmed',
      ]);
    } else if (!backpack_authentication_secondary_enabled()) { // If only primary is needed
      return Validator::make($data, [
        'name' => 'required|max:255',
        backpack_authentication_column() => backpack_authentication_validation(),
        'password' => 'required|min:6|confirmed',
      ]);
    }

    throw new \Exception('Invalid authentication configuration');
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param array $data
   * @return \Illuminate\Contracts\Auth\Authenticatable
   */
  protected function create(array $data)
  {
    $user_model_fqn = config('backpack.base.user_model_fqn');
    $user = new $user_model_fqn();
    $newUser = $user->create([
      backpack_authentication_column() => $data[backpack_authentication_column()],
      backpack_authentication_secondary_enabled() ? backpack_authentication_secondary_column() : null => $data[backpack_authentication_secondary_column()],
      'password' => Hash::make($data['password']),
    ]);
    $newUser->assignRole('User');
    return $newUser;
  }

  /**
   * Show the application registration form.
   *
   * @return \Illuminate\Contracts\View\View
   */
  public function showRegistrationForm()
  {
    // Check if the user is logged in
    if (backpack_auth()->check()) {
      return redirect(route('routes.web.dashboard.index'));
    }


    // if registration is closed, deny access
    if (!config('backpack.base.registration_open')) {
      abort(403, trans('backpack::base.registration_closed'));
    }
    $this->data['title'] = trans('backpack::base.register'); // set the page title

    return view(backpack_view('auth.register'), $this->data);
  }

  /**
   * Handle a registration request for the application.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\View
   */
  public function register(Request $request)
  {
    // if registration is closed, deny access
    if (!config('backpack.base.registration_open')) {
      abort(403, trans('backpack::base.registration_closed'));
    }

    $this->validator($request->all())->validate();
    $user = $this->create($request->all());
//    event(new Registered($user)); // MustVerifyEmail sends the email verification email already
    if (config('backpack.base.setup_email_verification_routes')) {
      Cookie::queue('backpack_email_verification', $user->{config('backpack.base.email_column')}, 30);
      return redirect(route('verification.notice'));
    }
    $this->guard()->login($user);

    return redirect($this->redirectPath());
  }

  /**
   * Get the guard to be used during registration.
   *
   * @return \Illuminate\Contracts\Auth\StatefulGuard
   */
  protected function guard()
  {
    return backpack_auth();
  }
}
