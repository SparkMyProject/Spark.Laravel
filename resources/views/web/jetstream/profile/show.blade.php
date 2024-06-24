@extends('tablar::page')

@php
$breadcrumbs = [['link' => 'home', 'name' => 'Home'], ['link' => 'javascript:void(0)', 'name' => 'User'], ['name' => 'Profile']];
@endphp

@section('title', 'Profile')


@section('content')
  <div class="page-wrapper">
    @include('components._partials.page-title', ['pagetitle' => 'Profile', 'breadcrumbs' => $breadcrumbs])

    <div class="page-body container-xl">
      @if (Laravel\Fortify\Features::canUpdateProfileInformation())
        <div class="mb-4">
          @livewire('jetstream.profile.update-profile-information-form')
        </div>
      @endif

      @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <div class="mb-4">
          @livewire('jetstream.profile.update-password-form')
        </div>
      @endif

      @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
        <div class="mb-4">
          @livewire('jetstream.profile.two-factor-authentication-form')
        </div>
      @endif

      <div class="mb-4">
        @livewire('jetstream.profile.logout-other-browser-sessions-form')
      </div>

      @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
        @livewire('jetstream.profile.delete-user-form')
      @endif
    </div>
  </div>



@endsection
