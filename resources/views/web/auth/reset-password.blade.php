@extends('tablar::auth.layout')

@section('content')
  <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="row">
          <div class="col col-login mx-auto">
            <div class="text-center mb-6">
              <a href="{{url('/')}}"><img src="{{asset('assets/brand/tabler.svg')}}" class="h-6" alt=""></a>
            </div>
            <form class="card" action="{{ route('password.update') }}" method="POST">
              @csrf
              <input type="hidden" name="token" value="{{ $request->route('token') }}">
              <div class="card-body card-md">
                <div class="card-title">Reset Password</div>
                <div class="form-group">
                  <label class="form-label">Email address</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email" value="{{Request()->email}}" readonly>
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                                    <span class="fw-medium">{{ $message }}</span>
                                </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-label">New Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                                    <span class="fw-medium">{{ $message }}</span>
                                </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" id="confirm-password" name="password_confirmation" placeholder="Confirm Password">
                </div>
                <div class="form-footer">
                  <button type="submit" class="btn btn-primary btn-block">Set new password</button>
                </div>
              </div>
            </form>
            <div class="text-center text-muted">
              Forget it, <a href="{{ route('login') }}">send me back</a> to the sign in screen.
            </div>
          </div>
        </div>
    </div>
  </div>
@endsection
