<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;

class OAuthController extends Controller
{

  public function discord() {
    return Socialite::driver('discord')->redirect();
  }
}
