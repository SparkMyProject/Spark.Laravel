@extends('tablar::auth.layout')
@section('title', 'Login')
@section('content')
  <div class="container container-tight py-4">
    <div class="text-center mb-1 mt-5">
      <a href="" class="navbar-brand navbar-brand-autodark">
        <img src="{{asset(config('tablar.auth_logo.img.path','assets/logo.svg'))}}" height="36"
             alt=""></a>
    </div>
    <div class="card card-md">
      <div class="card-body">
        <h2 class="h2 text-center mb-4">Login to your account</h2>
        @if (session('status'))
          <div class="alert alert-success mb-1 rounded-0" role="alert">
            <div class="alert-body">
              {{ session('status') }}
            </div>
          </div>
        @endif
        @env('local')
          <x-login-link key="1" label="Webmaster Login"/>
        @endenv
        {{-- Disabled / Banned alerts, using alerts, rather than withError for form validation --}}
        @if (session('error'))
          <div class="alert alert-danger mb-1 rounded-0" role="alert">
            <div class="alert-body">
              {{ session('error') }}
            </div>
          </div>
        @endif

        <form id="formAuthentication" action="{{route('login')}}" method="post" autocomplete="off">
          @csrf
          <div class="mb-3">
            <label for="login-username" class="form-label">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror"
                   id="login-username" name="username" placeholder="johndoe123" autofocus
                   value="{{ old('username') }}">

            @error('username')
            <span class="invalid-feedback" role="alert">
              <span class="fw-medium">{{ $message }}</span>
            </span>
            @enderror

          </div>
          <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="login-password">Password</label>
              @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                  <small>Forgot Password?</small>
                </a>
              @endif
            </div>
            <div class="input-group input-group-merge @error('password') is-invalid @enderror">
              <input type="password" id="login-password"
                     class="form-control @error('password') is-invalid @enderror" name="password"
                     placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                     aria-describedby="password"/>
              <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
              <span class="fw-medium">{{ $message }}</span>
            </span>
            @enderror
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="remember-me"
                     name="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="remember-me">
                Remember Me
              </label>
            </div>
          </div>
          <button class="btn btn-primary w-100" type="submit">Sign in</button>
        </form>
      </div>
      <div class="hr-text">or</div>
      <div class="card-body">
        <a href="{{route('routes.web.auth.discord.redirect')}}" class="btn btn-icon w-100 btn-label-discord" style="background: #5865F2">
          <i class="tf-icons fa-brands fa-discord fs-5" style="margin-right: 5px; "></i>
          Login with Discord
        </a>

      </div>

    </div>
    @if(Route::has('register'))
      <div class="text-center text-muted mt-3">
        Don't have account yet? <a href="{{route('register')}}" tabindex="-1">Sign up</a>
      </div>
    @endif
  </div>
@endsection
