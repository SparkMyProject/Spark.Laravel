<?php

namespace App\Providers;

use App\Models\Authentication\User;
use Carbon\Carbon;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Illuminate\Contracts\Http\Kernel as HttpKernelContract;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Http\Kernel as HttpKernel;
use App\Console\Kernel as ConsoleKernel;
use App\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Vite;
use Laravel\Pulse\Facades\Pulse;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->singleton(HttpKernelContract::class, HttpKernel::class);
    $this->app->singleton(ConsoleKernelContract::class, ConsoleKernel::class);
    $this->app->singleton(ExceptionHandlerContract::class, ExceptionHandler::class);
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Vite::useStyleTagAttributes(function (?string $src, string $url, ?array $chunk, ?array $manifest) {
      if ($src !== null) {
        return [
          'class' => preg_match("/(resources\/assets\/vendor\/scss\/(rtl\/)?core)-?.*/i", $src) ? 'template-customizer-core-css' :
            (preg_match("/(resources\/assets\/vendor\/scss\/(rtl\/)?theme)-?.*/i", $src) ? 'template-customizer-theme-css' : '')
        ];
      }
      return [];
    });

    // Pulse
    Gate::define('viewPulse', function (User $user) {
      return $user->can('webmaster.pulse.view');
    });
    Pulse::user(fn ($user) => [
      'name' => $user->username,
      'extra' => $user->email,
      'avatar' => $user->profile_photo_url,
    ]);

    // User Timezones
    Carbon::macro('inUserTimezone', function () {
      return $this->tz(auth()->user()->timezone ?? config('app.display_timezone'));
  });
  }
}
