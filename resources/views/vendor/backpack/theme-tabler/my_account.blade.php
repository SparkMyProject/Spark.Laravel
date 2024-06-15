@extends(backpack_view('blank'))

@section('after_styles')
  <style media="screen">
    .backpack-profile-form .required::after {
      content: ' *';
      color: red;
    }
  </style>
@endsection

@php
  $breadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
      trans('backpack::base.my_account') => false,
  ];
@endphp

@section('header')
  <section class="content-header">
    <div class="container-fluid mb-3">
      <h1>{{ trans('backpack::base.my_account') }}</h1>
    </div>
  </section>
@endsection

@section('content')
  <div class="row">

    @if (session('success'))
      <div class="col-lg-8">
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      </div>
    @endif

    @if ($errors->count())
      <div class="col-lg-8">
        <div class="alert alert-danger">
          <ul class="mb-1">
            @foreach ($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    @endif

    {{-- UPDATE INFO FORM --}}
    <div class="col-lg-8 mb-4">
      <form class="form" action="{{ route('backpack.account.info.store') }}" method="post">

        {!! csrf_field() !!}

        <div class="card">

          <div class="card-header">
            <h3 class="card-title">{{ trans('backpack::base.update_account_info') }}</h3>
          </div>

          <div class="card-body backpack-profile-form bold-labels">
            <div class="row">
              <div class="col-md-6 form-group">
                @php
                  $label = 'First Name';
                  $field = 'first_name';
                @endphp
                <label class="required">{{ $label }}</label>
                <input required class="form-control" type="text" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->$field }}">
              </div>
              <div class="col-md-6 form-group">
                @php
                  $label = 'Last Name';
                  $field = 'last_name';
                @endphp
                <label class="required">{{ $label }}</label>
                <input required class="form-control" type="text" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->$field }}">
              </div>
            </div>
            <div class="row">

              <div class="col-md-6 form-group">
                @php
                  $label = 'Username';
                  $field = 'username';
                @endphp
                <label class="required">{{ $label }}</label>
                <input required class="form-control" type="text" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->$field }}" disabled>
              </div>

              <div class="col-md-6 form-group">
                @php
                  $label = 'Display Name';
                  $field = 'display_name'
                @endphp
                <label class="required">{{ $label }}</label>
                <input required class="form-control" type="text" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->$field }}">
              </div>
            </div>
            <div class="row">

              <div class="col-md-6 form-group">
                @php
                  $label = 'Email';
                  $field = 'email';
                @endphp
                <label class={{(backpack_authentication_column() == 'email' || (backpack_authentication_secondary_enabled() && backpack_authentication_secondary_column()
                              == 'email')) ? "required" : ""}}>{{ $label }}</label>
                <input required class="form-control" type="email" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->$field }}"
                  {{ (backpack_authentication_column() == 'email' || (backpack_authentication_secondary_enabled() && backpack_authentication_secondary_column()
                  == 'email')) ? '' : 'disabled' }}>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-success"><i class="la la-save"></i> {{ trans('backpack::base.save') }}</button>
            <a href="{{ backpack_url() }}" class="btn">{{ trans('backpack::base.cancel') }}</a>
          </div>
        </div>

      </form>
    </div>

    {{-- CHANGE PASSWORD FORM --}}
    <div class="col-lg-8 mb-4">
      <form class="form" action="{{ route('backpack.account.password') }}" method="post">

        {!! csrf_field() !!}

        <div class="card padding-10">

          <div class="card-header">
            <h3 class="card-title">{{ trans('backpack::base.change_password') }}</h3>
          </div>

          <div class="card-body backpack-profile-form bold-labels">
            <div class="row">
              <div class="col-md-4 form-group">
                @php
                  $label = trans('backpack::base.old_password');
                  $field = 'old_password';
                @endphp
                <label class="required">{{ $label }}</label>
                <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="">
              </div>

              <div class="col-md-4 form-group">
                @php
                  $label = trans('backpack::base.new_password');
                  $field = 'new_password';
                @endphp
                <label class="required">{{ $label }}</label>
                <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="">
              </div>

              <div class="col-md-4 form-group">
                @php
                  $label = trans('backpack::base.confirm_password');
                  $field = 'confirm_password';
                @endphp
                <label class="required">{{ $label }}</label>
                <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="">
              </div>
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-success"><i class="la la-save"></i> {{ trans('backpack::base.change_password') }}</button>
            <a href="{{ backpack_url() }}" class="btn">{{ trans('backpack::base.cancel') }}</a>
          </div>

        </div>

      </form>
    </div>

  </div>
@endsection
