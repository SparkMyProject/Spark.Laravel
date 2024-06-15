<?php
//
//use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Str;
//use Laravel\Jetstream\Http\Controllers\CurrentTeamController;
//use Laravel\Jetstream\Http\Controllers\Livewire\PrivacyPolicyController;
//use Laravel\Jetstream\Http\Controllers\Livewire\TeamController;
//use Laravel\Jetstream\Http\Controllers\Livewire\TermsOfServiceController;
//use Laravel\Jetstream\Http\Controllers\TeamInvitationController;
//use Laravel\Jetstream\Jetstream;
//
//Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
//  if (Jetstream::hasTermsAndPrivacyPolicyFeature()) {
//    Route::get('/jetstream/legal/privacy-policy', function () {
//      $termsFile = Jetstream::localizedMarkdownPath('policy.md');
//
//      return view('web.jetstream.legal.policy', [
//        'policy' => Str::markdown(file_get_contents($termsFile)),
//      ]);
//    })->name('routes.jetstream.legal.policy.show');
//
//    Route::get('/jetstream/legal/terms-of-service', function () {
//      $termsFile = Jetstream::localizedMarkdownPath('terms.md');
//
//      return view('web.jetstream.legal.terms', [
//        'terms' => Str::markdown(file_get_contents($termsFile)),
//      ]);
//    })->name('routes.jetstream.legal.terms.show');
//  }
//
//  $authMiddleware = config('jetstream.guard')
//    ? 'auth:' . config('jetstream.guard')
//    : 'auth';
//
//  $authSessionMiddleware = config('jetstream.auth_session', false)
//    ? config('jetstream.auth_session')
//    : null;
//
//  Route::group(['middleware' => array_values(array_filter([$authMiddleware, $authSessionMiddleware, 'verified']))], function () {
//    // User & Profile...
//    Route::get('/user/profile', function () {
//      return view('web.jetstream.profile.show', [
//        'request' => request(),
//        'user' => request()->user(),
//      ]);
//    })->name('routes.web.jetstream.profile.show');
//
//    Route::group(['middleware' => 'verified'], function () {
//      // API...
//      if (Jetstream::hasApiFeatures()) {
//        Route::get('/user/api-tokens', function () {
//          return view('jetstream.api.index', [
//            'request' => request(),
//            'user' => request()->user(),
//          ]);
//        })->name('routes.web.jetstream.api.index');
//      }
//
//      // Teams...
//      if (Jetstream::hasTeamFeatures()) {
//        Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
//        Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
//        Route::put('/current-team', [CurrentTeamController::class, 'update'])->name('current-team.update');
//
//        Route::get('/team-invitations/{invitation}', [TeamInvitationController::class, 'accept'])
//          ->middleware(['signed'])
//          ->name('routes.web.team-invitations.accept');
//      }
//    });
//  });
//});
