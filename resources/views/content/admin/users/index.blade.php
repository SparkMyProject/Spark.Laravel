@php
    use App\Models\Authentication\User;use App\Models\Role;
    $Auth = Auth::user();


@endphp
@extends('components.layouts.layoutMaster')

@section('title', 'User List - Pages')

@section('vendor-style')
    @vite([
      'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
      'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
      'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
      'resources/assets/vendor/libs/select2/select2.scss',
      'resources/assets/vendor/libs/@form-validation/form-validation.scss',
      'resources/assets/vendor/libs/animate-css/animate.css',
      'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'

    ])
@endsection

@section('vendor-script')
    @vite([
      'resources/assets/vendor/libs/moment/moment.js',
      'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
      'resources/assets/vendor/libs/select2/select2.js',
      'resources/assets/vendor/libs/@form-validation/popular.js',
      'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
      'resources/assets/vendor/libs/@form-validation/auto-focus.js',
      'resources/assets/vendor/libs/cleavejs/cleave.js',
      'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
      'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',
    ])
@endsection

{{--@section('page-script')--}}
{{--  @vite('resources/assets/js/app-user-list.js')--}}
{{--@endsection--}}

@section('content')
    <h4 class="mb-4">Users List</h4>
    <p class="mb-4">Manage users from here.</p>
    <div class="row g-4 mb-4">
        <div class="col-sm-3 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Session</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">{{$users->count()}}</h3>
                            </div>
                            <p class="mb-0">Total Users</p>
                        </div>
                        <div class="avatar">
            <span class="avatar-initial rounded bg-label-primary">
              <i class="ti ti-user ti-sm"></i>
            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-xl-2">
            <div class="card card-body d-flex align-items-start justify-content-between">
                <h5>UTC Time Now:</h5>
                <iframe
                        src="https://www.clocklink.com/html5embed.php?clock=043&timezone=GMT&color=black&size=180&Title=&Message=&Target=&From=2019,1,1,0,0,0&Color=black"
                        frameborder="0" allowTransparency="true"></iframe>
            </div>
        </div>
        <div class="col-sm-3 col-xl-2">
            <div class="card card-body d-flex align-items-start justify-content-between">
                <h5>Eastern Time Now:</h5>
                <iframe
                        src="https://www.clocklink.com/html5embed.php?clock=043&timezone=EST&color=black&size=180&Title=&Message=&Target=&From=2019,1,1,0,0,0&Color=black"
                        frameborder="0" allowTransparency="true"></iframe>
            </div>
        </div>
        <div class="col-sm-3 col-xl-2">
            <div class="card card-body d-flex align-items-start justify-content-between">
                <h5>Central Time Now:</h5>
                <iframe
                        src="https://www.clocklink.com/html5embed.php?clock=043&timezone=CST&color=black&size=180&Title=&Message=&Target=&From=2019,1,1,0,0,0&Color=black"
                        frameborder="0" allowTransparency="true"></iframe>
            </div>
        </div>
        <div class="col-sm-3 col-xl-2">
            <div class="card card-body d-flex align-items-start justify-content-between">
                <h5>Pacific Time Now:</h5>
                <iframe
                        src="https://www.clocklink.com/html5embed.php?clock=043&timezone=PST&color=black&size=180&Title=&Message=&Target=&From=2019,1,1,0,0,0&Color=black"
                        frameborder="0" allowTransparency="true"></iframe>
            </div>
        </div>
    </div>
    <!-- Users List Table -->
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-3">Search Filter</h5>
            <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
                <div class="col-md-4 user_role"></div>
                <div class="col-md-4 user_plan"></div>
                <div class="col-md-4 user_status"></div>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-users table">
                <thead class="border-top">
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Discord</th>
                    <th>Account Status</th>
                    <th>Timezone</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="sorting_1">

                            <div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-3">
                                        <img src="{{$user->profile_photo_url}}" alt="Avatar" class="rounded-circle">
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <a class="text-body text-truncate">
                                        <span class="fw-medium">{{$user->username}}</span>
                                    </a><small class="text-muted">{{$user->full_name ?? 'No Name'}}</small>
                                </div>
                            </div>
                        </td>

                        <td>
                        <span class="text-truncate d-flex align-items-center">
                            <span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2">

                                <i class="{{$user->roles->first()->icon}}"></i>
                            </span>{{$user->roles->first()->name}}
                        </span>
                        </td>

                        <td>
            <span class="text-truncate d-flex align-items-center">
              <div class="avatar-wrapper">
                @if($user->oauthUser)
                      <div class="d-flex justify-content-start align-items-center user-name">
                    <div class="avatar-wrapper">
                        <div class="avatar me-3">
                          <img src="{{$user->oauthUser->avatar}}" alt="Avatar"
                               class="rounded-circle"/>

                        </div>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="app-user-view-account.html" class="text-body text-truncate">
                                <span class="fw-medium">{{$user->oauthUser->username}}</span>
                            </a><small class="text-muted">{{$user->oauthUser->email}}</small>
                        </div>
                    </div>
                  @else
                      <div class=" d-flex flex-column">
                  <a href="app-user-view-account.html" class="text-body text-truncate">
                    <span class="fw-medium">N/A</span>
                  </a>
                 </div>
                  @endif
              </div>
            </span></td>
                        <td>
              <span class="text-truncate d-flex align-items-center">
                @if($user->account_status == 'Active')
                      <span class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30 me-2">
                    <i class="ti ti-check ti-sm"></i>
                  </span>Active
                  @elseif($user->account_status == 'Disabled')
                      <span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2">
                    <i class="ti ti-x ti-sm"></i>
                  </span>Disabled
                  @elseif($user->account_status == 'Banned')
                      <span class="badge badge-center rounded-pill bg-label-danger w-px-30 h-px-30 me-2">
                  <i class="ti ti-x ti-sm"></i>
                </span>Banned
                  @endif
              </span>
                        </td>

                        <td>
              <span class="text-truncate d-flex align-items-center">
                <span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2">
                  <i class="ti ti-world ti-sm"></i>
                </span>{{$user->timezone}}
              </span>

                        </td>

                        <td>

                            <div class="d-flex align-items-center">
                                <a data-bs-toggle="modal" data-bs-target="#editUserModal-{{$user->id}}" href="javascript:"
                                   class="text-body">
                                    <i class="ti ti-edit ti-sm me-2"></i>
                                </a>
                                @include('components.admin.users.edit-user-modal', ['user' => $user])


                                <a href="javascript:" class="text-body delete-record">
                                    <i class="ti ti-trash ti-sm mx-2"></i>
                                </a>

                                <a href="javascript:" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical ti-sm mx-1"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end m-0">

                                    <a href="{{route("routes.content.admin.users.view", ['id' => $user->id])}}"
                                       class="dropdown-item">View</a>
                                    <button {{-- Needs to be button because it is javascript --}}
                                            class="{{$user->account_status == 'Active' ? 'disable' : 'enable'}}-user-button dropdown-item button"
                                            data-user-id={{$user->id}}>
                                        {{$user->account_status == 'Active' ? 'Disable' : 'Enable'}}
                                    </button>
                                    <a data-bs-toggle="modal" data-bs-target="#editUserRolesModal-{{$user->id}}" href="javascript:"
                                       class="dropdown-item">Edit Roles</a>

                                </div>
                                {{--                Cannot be in the div because that is a drop down menu--}}
                                @include('components.admin.users.edit-user-roles-modal', ['user' => $user], ['roles' => $roles])

                            </div>
                        </td>
                    </tr>


                @endforeach

            </table>
        </div>
    </div>

    @include('components.admin.users.toggle-acct-status-alert')
@endsection
