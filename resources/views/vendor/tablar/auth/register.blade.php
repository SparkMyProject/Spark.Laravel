@extends('tablar::auth.layout')
@section('title', 'Register')
@section('content')
    <div class="container container-tight py-4">
        <div class="text-center mb-1 mt-5">
            <a href="" class="navbar-brand navbar-brand-autodark">
                <img src="{{asset(config('tablar.auth_logo.img.path','assets/logo.svg'))}}" height="36"
                     alt=""></a>
        </div>
      <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control @error('username') is-invalid @enderror"
                 id="username" name="username" placeholder="johndoe" autofocus
                 value="{{ old('username') }}"/>
          @error('username')
          <span class="invalid-feedback" role="alert">
              <span class="fw-medium">{{ $message }}</span>
            </span>
          @enderror
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror"
                 id="email" name="email" placeholder="johndoe@example.com" autofocus
                 value="{{ old('email') }}"/>
          @error('email')
          <span class="invalid-feedback" role="alert">
              <span class="fw-medium">{{ $message }}</span>
            </span>
          @enderror
        </div>

        <div class="mb-3 form-password-toggle">
          <label class="form-label" for="password">Password</label>
          <div class="input-group input-group-merge @error('password') is-invalid @enderror">
            <input type="password" id="password"
                   class="form-control @error('password') is-invalid @enderror" name="password"
                   placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                   aria-describedby="password"/>
            <span class="input-group-text cursor-pointer">
                <i class="ti ti-eye-off"></i>
              </span>
          </div>
          @error('password')
          <span class="invalid-feedback" role="alert">
              <span class="fw-medium">{{ $message }}</span>
            </span>
          @enderror
        </div>

        <div class="mb-3 form-password-toggle">
          <label class="form-label" for="password-confirm">Confirm Password</label>
          <div class="input-group input-group-merge">
            <input type="password" id="password-confirm" class="form-control"
                   name="password_confirmation"
                   placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                   aria-describedby="password"/>
            <span class="input-group-text cursor-pointer">
                <i class="ti ti-eye-off"></i>
              </span>
          </div>
        </div>
        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
          <div class="mb-3">
            <div class="form-check @error('terms') is-invalid @enderror">
              <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox"
                     id="terms" name="terms"/>
              <label class="form-check-label" for="terms">
                I agree to the
                <a href="{{ route('policy.show') }}" target="_blank">privacy policy</a> &
                <a href="{{ route('terms.show') }}" target="_blank">terms</a>
              </label>
            </div>
            @error('terms')
            <div class="invalid-feedback" role="alert">
              <span class="fw-medium">{{ $message }}</span>
            </div>
            @enderror
          </div>
        @endif
        <button type="submit" class="btn btn-primary d-grid w-100">Sign up</button>
      </form>
      <div class="hr-text">or</div>

      {{--      Discord SSO--}}
      <div class="card-body">
        <a href="{{route('routes.web.auth.discord.redirect')}}" class="btn btn-icon w-100 text-white" style="background: #5865F2;">
          <i class="tf-icons fa-brands fa-discord fs-5" style="margin-right: 5px; "></i>
          Register with Discord
        </a>
      </div>
        <div class="text-center text-muted mt-3">
            Already have account? <a href="{{route('login')}}" tabindex="-1">Sign in</a>
        </div>
    </div>
@endsection
