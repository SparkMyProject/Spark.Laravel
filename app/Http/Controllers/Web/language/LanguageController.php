<?php

namespace App\Http\Controllers\Web\language;

use App\Http\Controllers\Web\Controller;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
  public function swap($locale)
  {

    if (!in_array($locale, ['en', 'fr', 'ar', 'de'])) {
      abort(400);
    } else {
      session()->put('locale', $locale);
    }

    App::setLocale($locale);
    return redirect()->back();
  }
}