<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Http\Livewire\Jetstream\Profile\ApiTokenManager;
use App\Http\Livewire\Jetstream\Profile\CreateTeamForm;
use App\Http\Livewire\Jetstream\Profile\DeleteTeamForm;
use App\Http\Livewire\Jetstream\Profile\DeleteUserForm;
use App\Http\Livewire\Jetstream\Profile\LogoutOtherBrowserSessionsForm;
use App\Http\Livewire\Jetstream\Profile\TeamMemberManager;
use App\Http\Livewire\Jetstream\Profile\TwoFactorAuthenticationForm;
use App\Http\Livewire\Jetstream\Profile\UpdatePasswordForm;
use App\Http\Livewire\Jetstream\Profile\UpdateProfileInformationForm;
use App\Http\Livewire\Jetstream\Profile\UpdateTeamNameForm;
use App\Http\Livewire\NavigationMenu;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\Jetstream;
use Livewire\Livewire;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

      if (config('jetstream.stack') === 'livewire' && class_exists(Livewire::class)) {
        Livewire::component('navigation-menu', NavigationMenu::class);
        Livewire::component('jetstream.profile.update-profile-information-form', UpdateProfileInformationForm::class);
        Livewire::component('jetstream.profile.update-password-form', UpdatePasswordForm::class);
        Livewire::component('jetstream.profile.two-factor-authentication-form', TwoFactorAuthenticationForm::class);
        Livewire::component('jetstream.profile.logout-other-browser-sessions-form', LogoutOtherBrowserSessionsForm::class);
        Livewire::component('jetstream.profile.delete-user-form', DeleteUserForm::class);

        if (Features::hasApiFeatures()) {
          Livewire::component('jetstream.api.api-token-manager', ApiTokenManager::class);
        }

        if (Features::hasTeamFeatures()) {
          Livewire::component('jetstream.teams.create-team-form', CreateTeamForm::class);
          Livewire::component('jetstream.teams.update-team-name-form', UpdateTeamNameForm::class);
          Livewire::component('jetstream.teams.team-member-manager', TeamMemberManager::class);
          Livewire::component('jetstream.teams.delete-team-form', DeleteTeamForm::class);
        }
      }
    }

    /**
     * Configure the permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
