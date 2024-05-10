@php
  use App\Models\Authentication\User;use App\Models\Role;
  $Auth = Auth::user();
    $users = User::with(['roles' => function ($query) {
    $query->orderBy('priority', 'desc');
  }])->with("oauthUser")->get();

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
  @include('components/_partials/alert-handling')
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
                  <a href="app-user-view-account.html" class="text-body text-truncate">
                    <span class="fw-medium">{{$user->username}}</span>
                  </a><small class="text-muted">{{$user->email}}</small>
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
                               class="rounded-circle" />

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
                @else
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

                  <a href="" class="dropdown-item">View</a>
                  <button
                    class="{{$user->account_status == 'Active' ? 'disable' : 'enable'}}-user-button dropdown-item button"
                    data-user-id={{$user->id}}>{{$user->account_status == 'Active' ? 'Disable' : 'Enable'}}
                  </button>

                </div>
              </div>
            </td>
          </tr>


        @endforeach

      </table>
    </div>
    <!-- Offcanvas to add new user -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
      <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="add-new-user pt-0" id="addNewUserForm" onsubmit="return false">
          <div class="mb-3">
            <label class="form-label" for="add-user-fullname">Full Name</label>
            <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe" name="userFullname"
                   aria-label="John Doe" />
          </div>
          <div class="mb-3">
            <label class="form-label" for="add-user-email">Email</label>
            <input type="text" id="add-user-email" class="form-control" placeholder="john.doe@example.com"
                   aria-label="john.doe@example.com" name="userEmail" />
          </div>
          <div class="mb-3">
            <label class="form-label" for="add-user-contact">Contact</label>
            <input type="text" id="add-user-contact" class="form-control phone-mask" placeholder="+1 (609) 988-44-11"
                   aria-label="john.doe@example.com" name="userContact" />
          </div>
          <div class="mb-3">
            <label class="form-label" for="add-user-company">Company</label>
            <input type="text" id="add-user-company" class="form-control" placeholder="Web Developer" aria-label="jdoe1"
                   name="companyName" />
          </div>
          <div class="mb-3">
            <label class="form-label" for="country">Country</label>
            <select id="country" class="select2 form-select">
              <option value="">Select</option>
              <option value="Australia">Australia</option>
              <option value="Bangladesh">Bangladesh</option>
              <option value="Belarus">Belarus</option>
              <option value="Brazil">Brazil</option>
              <option value="Canada">Canada</option>
              <option value="China">China</option>
              <option value="France">France</option>
              <option value="Germany">Germany</option>
              <option value="India">India</option>
              <option value="Indonesia">Indonesia</option>
              <option value="Israel">Israel</option>
              <option value="Italy">Italy</option>
              <option value="Japan">Japan</option>
              <option value="Korea">Korea, Republic of</option>
              <option value="Mexico">Mexico</option>
              <option value="Philippines">Philippines</option>
              <option value="Russia">Russian Federation</option>
              <option value="South Africa">South Africa</option>
              <option value="Thailand">Thailand</option>
              <option value="Turkey">Turkey</option>
              <option value="Ukraine">Ukraine</option>
              <option value="United Arab Emirates">United Arab Emirates</option>
              <option value="United Kingdom">United Kingdom</option>
              <option value="United States">United States</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label" for="user-role">User Role</label>
            <select id="user-role" class="form-select">
              <option value="subscriber">Subscriber</option>
              <option value="editor">Editor</option>
              <option value="maintainer">Maintainer</option>
              <option value="author">Author</option>
              <option value="admin">Admin</option>
            </select>
          </div>
          <div class="mb-4">
            <label class="form-label" for="user-plan">Select Plan</label>
            <select id="user-plan" class="form-select">
              <option value="basic">Basic</option>
              <option value="enterprise">Enterprise</option>
              <option value="company">Company</option>
              <option value="team">Team</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
      </div>
    </div>
  </div>

  @include('components.admin.users.toggle-acct-status-alert')
@endsection
