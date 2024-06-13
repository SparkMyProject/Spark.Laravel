<div>
  <x-form-section submit="updateProfileInformation">
    <x-slot name="title">
      {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
      {{ __('Update your account\'s profile information and email address. If you sync your Discord profile picture and it is outdated, please log back in first.') }}
    </x-slot>

    <x-slot name="form">

      <x-action-message on="saved">
        {{ __('Saved.') }}
      </x-action-message>

      <!-- Profile Photo -->
      @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div class="mb-3" x-data="{photoName: null, photoPreview: null}">
          <!-- Profile Photo File Input -->
          <input type="file" hidden wire:model.live="photo" x-ref="photo"
                 x-on:change=" photoName = $refs.photo.files[0].name; const reader = new FileReader(); reader.onload = (e) => { photoPreview = e.target.result;}; reader.readAsDataURL($refs.photo.files[0]);"/>

          <!-- Current Profile Photo -->
          <div class="mt-2" x-show="! photoPreview">
            <img src="{{ $this->user->profile_photo_url }}" class="rounded-circle" height="80px" width="80px">
          </div>

          <!-- New Profile Photo Preview -->
          <div class="mt-2" x-show="photoPreview">
            <img x-bind:src="photoPreview" class="rounded-circle" width="80px" height="80px">
          </div>

          <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
            {{ __('Select A New Photo') }}
          </x-secondary-button>

          @if ($this->user->oauthUser)
            <x-secondary-button class="mt-2 me-2" type="button" wire:click="syncDiscordAvatar">
              {{ __('Sync Discord Photo') }}
            </x-secondary-button>
          @endif

          @if ($this->user->profile_photo_path)
            <button type="button" class="btn btn-danger text-uppercase mt-2" wire:click="deleteProfilePhoto">
              {{ __('Remove Photo') }}
            </button>
          @endif

          <x-input-error for="photo" class="mt-2"/>
        </div>
      @endif


      {{-- First/Last & Display Name --}}
      <div class="row">

        <div class="col-12 col-md-4">
          <x-label class="form-label" for="display_name" value="{{ __('Display Name') }}"/>
          <x-input id="display_name" type="text" class="{{ $errors->has('display_name') ? 'is-invalid' : '' }}"
                   wire:model="state.display_name" autocomplete="display_name"/>
          <x-input-error for="display_name"/>
        </div>

        <!-- First Name -->
        <div class="col-12 col-md-4">
          <x-label class="form-label" for="first_name" value="{{ __('First Name') }}"/>
          <x-input id="first_name" type="text" class="{{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                   wire:model="state.first_name" autocomplete="first_name"/>
          <x-input-error for="first_name"/>
        </div>

        <!-- Last Name -->
        <div class="col-12 col-md-4">

          <x-label class="form-label" for="last_name" value="{{ __('Last Name') }}"/>
          <x-input id="last_name" type="text" class="{{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                   wire:model="state.last_name" autocomplete="last_name"/>
          <x-input-error for="last_name"/>
        </div>
      </div>

      <br>
      <!-- Email -->
      <div class="mb-3">
        <x-label class="form-label" for="email" value="{{ __('Email') }}"/>
        <x-input id="email" type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                 wire:model="state.email"/>
        <x-input-error for="email"/>
      </div>

      <div class="row">

        <!-- Status -->
        <div class="col-12 col-md-6">
          <x-label class="form-label" for="status" value="{{ __('Status') }}"/>
          <x-input id="status" type="status" class="{{ $errors->has('status') ? 'is-invalid' : '' }}"
                   wire:model="state.status"/>
          <x-input-error for="status"/>
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label" for="account_status">Timezone</label>
          <select id="timezone" wire:model="state.timezone" class="select2 form-select" aria-label="Default select example">
            <option value="test">Select a timezone</option>
            @foreach(DateTimeZone::listIdentifiers(DateTimeZone::ALL) as $tz)
              <option {{ $state['timezone'] == $tz ? 'selected' : '' }} value="{{ $tz }}">{{ $tz }}</option>
            @endforeach
          </select>
          <x-input-error for="timezone"/>
        </div>
      </div>
      <br>
    </x-slot>

    <x-slot name="actions">
      <div class="d-flex align-items-baseline">
        <x-button>
          {{ __('Save') }}
        </x-button>
      </div>
    </x-slot>
  </x-form-section>
</div>
