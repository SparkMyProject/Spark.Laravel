<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class OAuthController extends Controller
{

  public function discord() {
    return Socialite::driver('discord')->redirect();
  }
}
