@php
  $configData = Helper::appClasses();
@endphp

@extends('components.layouts.layoutMaster')

@section('title', 'Roles - Apps')

@section('vendor-style')
  @vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
    'resources/assets/vendor/libs/@form-validation/form-validation.scss',
      'resources/assets/vendor/libs/select2/select2.scss',
    ])
@endsection

@section('vendor-script')
  @vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js',
      'resources/assets/vendor/libs/select2/select2.js',
    ])
@endsection


@section('content')
  <h4 class="mb-4">Roles List</h4>

  <p class="mb-4">A role provided access to predefined menus and features so that depending on <br> assigned role an
    administrator can have access to what user needs.</p>
  @include('components._partials.alert-handling')

  <!-- Role cards -->
  <div class="row g-4">
    <div class="col-xl-4 col-lg-6 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h6 class="fw-normal mb-2">Total 4 users</h6>
            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Vinnie Mostowy"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Allen Rieske"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/12.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Julee Rossignol"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/3.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Doe"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar">
              </li>
            </ul>
          </div>
          <div class="d-flex justify-content-between align-items-end mt-1">
            <div class="role-heading">
              <h4 class="mb-1">Administrator</h4>
              <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                 class="role-edit-modal"><span>Edit Role</span></a>
            </div>
            <a href="javascript:void(0);" class="text-muted"><i class="ti ti-copy ti-md"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h6 class="fw-normal mb-2">Total 7 users</h6>
            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Ressula"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/4.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Doe"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kristi Lawker"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/2.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/3.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Danny Paul"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/7.png') }}" alt="Avatar">
              </li>
            </ul>
          </div>
          <div class="d-flex justify-content-between align-items-end mt-1">
            <div class="role-heading">
              <h4 class="mb-1">Manager</h4>
              <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                 class="role-edit-modal"><span>Edit Role</span></a>
            </div>
            <a href="javascript:void(0);" class="text-muted"><i class="ti ti-copy ti-md"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h6 class="fw-normal mb-2">Total 5 users</h6>
            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Andrew Tye"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Rishi Swaat"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/9.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Rossie Kim"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/12.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Merchent"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/10.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Sam D'souza"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/13.png') }}" alt="Avatar">
              </li>
            </ul>
          </div>
          <div class="d-flex justify-content-between align-items-end mt-1">
            <div class="role-heading">
              <h4 class="mb-1">Users</h4>
              <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                 class="editRoleModal"><span>Edit Role</span></a>
            </div>
            <a href="javascript:void(0);" class="text-muted"><i class="ti ti-copy ti-md"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h6 class="fw-normal mb-2">Total 3 users</h6>
            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Karlos"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/3.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Katy Turner"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/9.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Peter Adward"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/4.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/10.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Parker"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/11.png') }}" alt="Avatar">
              </li>
            </ul>
          </div>
          <div class="d-flex justify-content-between align-items-end mt-1">
            <div class="role-heading">
              <h4 class="mb-1">Support</h4>
              <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                 class="role-edit-modal"><span>Edit Role</span></a>
            </div>
            <a href="javascript:void(0);" class="text-muted"><i class="ti ti-copy ti-md"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h6 class="fw-normal mb-2">Total 2 users</h6>
            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Merchent"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/10.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Sam D'souza"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/13.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Nurvi Karlos"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Andrew Tye"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/8.png') }}" alt="Avatar">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Rossie Kim"
                  class="avatar avatar-sm pull-up">
                <img class="rounded-circle" src="{{ asset('assets/img/avatars/9.png') }}" alt="Avatar">
              </li>
            </ul>
          </div>
          <div class="d-flex justify-content-between align-items-end mt-1">
            <div class="role-heading">
              <h4 class="mb-1">Restricted User</h4>
              <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                 class="role-edit-modal"><span>Edit Role</span></a>
            </div>
            <a href="javascript:void(0);" class="text-muted"><i class="ti ti-copy ti-md"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6">
      <div class="card h-100">
        <div class="row h-100">
          <div class="col-sm-5">
            <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
              <img src="{{ asset('assets/img/illustrations/add-new-roles.png') }}" class="img-fluid mt-sm-4 mt-md-0"
                   alt="add-new-roles" width="83">
            </div>
          </div>
          <div class="col-sm-7">
            <div class="card-body text-sm-end text-center ps-sm-0">
              <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
                      class="btn btn-primary mb-2 text-nowrap add-new-role">Add New Role
              </button>
              <p class="mb-0 mt-1">Add role, if it does not exist</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12">
      <!-- Role Table -->
      <div class="card">
        <div class="card-datatable table-responsive">
          <table class="datatables-users table border-top">
            <thead>
            <tr>
              <th>Role</th>
              <th>Description</th>
              <th>Permissions Count</th>
              <th>User Count</th>
              <th>Priority</th>
              <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach($roles as $role)
              <tr class="odd">
                <td class="sorting_1">
                  <div class="d-flex justify-content-left align-items-center">
                      <span class="text-truncate d-flex align-items-center">
                        <span class="badge badge-center rounded-pill bg-label-primary me-3 w-px-30 h-px-30">
                          <i class="{{$role->icon}}"></i>
                        </span>
                        {{$role->name}}
                      </span>
                  </div>
                </td>
                <td>{{$role->description}}</td>
                <td>{{$role->permissions_count}}</td>
                <td>{{$role->users_count}}</td>
                <td>{{$role->priority}}</td>
                <td>
                  <div class="d-flex align-items-center">
                    <a data-bs-toggle="modal" data-bs-target="#editRoleModal-{{$role->id}}" href="javascript:"
                       class="text-body">
                      <i class="ti ti-edit ti-sm me-2"></i>
                    </a>
                    @include('components.admin.settings.roles.edit-role-modal', ['role' => $role])

                    <a data-bs-toggle="modal" data-bs-target="#editRolePermissionsModal-{{$role->id}}" href="javascript:"
                       class="text-body">
                      <i class="ti ti-lock ti-sm me-2"></i>
                    </a>
                    @include('components.admin.settings.roles.edit-role-permissions-modal', ['role' => $role], ['permissions' => $permissions])
                  </div>
                </td>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Role Table -->
    </div>
  </div>
  <!--/ Role cards -->

@endsection
