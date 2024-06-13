<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    api: __DIR__ . '/../routes/api.php',
    commands: __DIR__ . '/../routes/console.php',
    channels: __DIR__ . '/../routes/channels.php',
    health: '/up',
    then: function () {
      Route::middleware('web')
        ->group(base_path('routes/web/admin/settings.php'));
      Route::middleware('web')
        ->group(base_path('routes/web/admin/users.php'));
      Route::middleware('web')
        ->group(base_path('routes/web/authentication.php'));
      Route::middleware('web')
        ->group(base_path('routes/jetstream.php'));
      Route::middleware('web')
        ->group(base_path('routes/web/dashboard/dashboard.php'));
    }
  )
  ->withMiddleware(function (Middleware $middleware) {

    $middleware->use([
      \App\Http\Middleware\TrustProxies::class,
      \Illuminate\Http\Middleware\HandleCors::class,
      \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
      \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
      \App\Http\Middleware\TrimStrings::class,
      \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ]);

    // Add middleware configurations here if needed
    $middleware->appendToGroup('web', [
      \App\Http\Middleware\EncryptCookies::class,
      \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
      \Illuminate\Session\Middleware\StartSession::class,
      \Illuminate\View\Middleware\ShareErrorsFromSession::class,
      \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
      \Illuminate\Routing\Middleware\SubstituteBindings::class,
      \App\Http\Middleware\LocaleMiddleware::class,
    ]);

    $middleware->appendToGroup('api', [
      // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
      \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',
      \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ]);

    $middleware->alias([
      'auth' => \App\Http\Middleware\Authenticate::class,
      'auth.basic' => \App\Http\Middleware\AuthenticateWithBasicAuth::class,
      'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
      'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
      'canCustom' => \App\Http\Middleware\CanMiddleware::class, // Previously Authorize::class
      'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
      'password.confirm' => \App\Http\Middleware\RequirePassword::class,
      'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
      'signed' => \App\Http\Middleware\ValidateSignature::class,
      'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
      'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
      'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
      'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
      'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
    ]);
  })
  ->withExceptions(function (Exceptions $exceptions) {
    // Add exception handling configurations here if needed

    // Sentry Logging
    \Sentry\Laravel\Integration::handles($exceptions);
  })
  ->create();
