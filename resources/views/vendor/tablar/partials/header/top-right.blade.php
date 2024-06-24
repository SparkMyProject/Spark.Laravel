<div class="nav-item dropdown">
    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
       aria-label="Open user menu">
      <div class="avatar avatar-online">
        <img src="{{ Auth::user()->profile_photo_url}}" alt class="h-auto rounded-circle">
      </div>
        <div class="d-none d-xl-block ps-2">
            <div>{{Auth::user()->displayName}}</div>
            <div class="mt-1 small text-muted">{{Auth::user()->getHighestRole()->name}}</div>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

        <a href="{{ Route::has('routes.web.jetstream.profile.show') ? route('routes.web.jetstream.profile.show') : 'javascript:void(0);' }}"
        class="dropdown-item">Profile</a>
        <a class="dropdown-item"
           href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-fw fa-power-off text-red"></i>
            {{ __('tablar::tablar.log_out') }}
        </a>

      <form method="POST" id="logout-form" action="{{ route('logout') }}">
        @csrf
      </form>

    </div>
</div>
