<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Access\Gate;

class CanMiddleware
{


  /**
   * The gate instance.
   *
   * @var \Illuminate\Contracts\Auth\Access\Gate
   */
  protected $gate;

  /**
   * Create a new middleware instance.
   *
   * @param \Illuminate\Contracts\Auth\Access\Gate $gate
   * @return void
   */
  public function __construct(Gate $gate)
  {
    $this->gate = $gate;
  }

  /**
   * Specify the ability and models for the middleware.
   *
   * @param string $ability
   * @param string ...$models
   * @return string
   */
  public static function using($ability, ...$models)
  {
    return static::class . ':' . implode(',', [$ability, ...$models]);
  }

  /**
   * Handle an incoming request.
   *
   * @param \Illuminate\Http\Request $request
   * @param \Closure $next
   * @param string $ability
   * @param array|null ...$models
   * @return mixed
   *
   * @throws \Illuminate\Auth\AuthenticationException
   * @throws \Illuminate\Auth\Access\AuthorizationException
   */
  public function handle($request, Closure $next, $ability, ...$models)
  {
    // Check if user is logged in, if not redirect to not authorized page
    if (!auth()->check()) return redirect()->route('routes.misc.errors.not-authorized');
    $user = auth()->user();

    // Check for verified email
    if ($user->email_verified_at == null) {
      return redirect()->route('verification.notice');
      // Check if user is disabled or banned, if so log them out and redirect to not authorized page (in case a user status is changed while they are logged in)

      if ($user->account_status == 'Disabled') {
        // An account that is disabled will already have an alert message displayed to them, so we can just redirect them to the dashboard
        // Check if url is dashboard or profile, if so let them through
        if ($request->route()->getName() == 'routes.content.dashboard.index' || $request->route()->getName() == 'routes.content.profile.index') {
          return $next($request);
        } else {
          return redirect()->route('routes.content.dashboard.index');
        }
      }
    }

    if ($user->account_status == 'Banned') {
      auth('web')->logout();
      session()->flash('error', 'Your account has been banned. Please contact support for more information.');
      return redirect()->route('routes.misc.errors.not-authorized');
    }


    // Check if user has the correct permissions to access the page
    $this->gate->authorize($ability, $this->getGateArguments($request, $models));
    return $next($request);
  }

  /**
   * Get the arguments parameter for the gate.
   *
   * @param \Illuminate\Http\Request $request
   * @param array|null $models
   * @return array
   */
  protected function getGateArguments($request, $models)
  {
    if (is_null($models)) {
      return [];
    }

    return collect($models)->map(function ($model) use ($request) {
      return $model instanceof Model ? $model : $this->getModel($request, $model);
    })->all();
  }

  /**
   * Get the model to authorize.
   *
   * @param \Illuminate\Http\Request $request
   * @param string $model
   * @return \Illuminate\Database\Eloquent\Model|string
   */
  protected function getModel($request, $model)
  {
    if ($this->isClassName($model)) {
      return trim($model);
    }

    return $request->route($model, null) ??
      ((preg_match("/^['\"](.*)['\"]$/", trim($model), $matches)) ? $matches[1] : null);
  }

  /**
   * Checks if the given string looks like a fully qualified class name.
   *
   * @param string $value
   * @return bool
   */
  protected function isClassName($value)
  {
    return str_contains($value, '\\');
  }
}
