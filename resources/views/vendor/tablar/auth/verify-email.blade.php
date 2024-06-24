@extends('tablar::auth.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <h3 class="mb-1 card-header">Verify your email ✉️</h3>
              @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success" role="alert">
                  <div class="alert-body">
                    A new verification link has been sent to the email address you provided during
                    registration.
                  </div>
                </div>
              @endif

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}

                        </div>
                    @endif
                      Account activation link sent to your email address: <span
                        class="fw-medium">{{Auth::user()->email}}</span> Please follow the link inside to
                      continue.
                      <br>
                      <br>
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('Resend Email') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
