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
        'resources/css/app.css',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'

      ])
@endsection

@section('vendor-script')
    @vite([
      'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
      'resources/assets/vendor/libs/@form-validation/popular.js',
      'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
      'resources/assets/vendor/libs/@form-validation/auto-focus.js',
        'resources/assets/vendor/libs/select2/select2.js',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',

      ])
@endsection


@section('content')
    <h4 class="mb-4">Roles List</h4>

    <p class="mb-4">A role provided access to predefined menus and features so that depending on <br> assigned role an
        administrator can have access to what user needs.</p>
    @csrf
    <div class="d-flex justify-content-between align-items-center mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoleModal">
            Create Role
        </button>
        @include('components.admin.settings.roles.create-role-modal')
    </div>
    <!-- Role cards -->
    <div class="row g-4">
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
                                        @if($role->is_system)
                                            {{--Have to use btn so it doesn't have a mouse effect--}}
                                            <btn href="javascript:" class="text-light">
                                                <i class="ti ti-edit ti-sm me-2"></i>
                                            </btn>

                                            <btn href="javascript:" class="text-light">
                                                <i class="ti ti-lock ti-sm me-2"></i>
                                            </btn>

                                            <btn href="javascript:" class="text-light">
                                                <i class="ti ti-trash ti-sm me-2"></i>
                                            </btn>
                                        @else
                                            <a data-bs-toggle="modal" data-bs-target="#editRoleModal-{{$role->id}}" href="javascript:"
                                               class="text-body">
                                                <i class="ti ti-edit ti-sm me-2"></i>
                                            </a>
                                            @include('components.admin.settings.roles.edit-role-modal', ['role' => $role])

                                            <a data-bs-toggle="modal" data-bs-target="#editRolePermissionsModal-{{$role->id}}"
                                               href="javascript:"
                                               class="text-body">
                                                <i class="ti ti-lock ti-sm me-2"></i>
                                            </a>
                                            @include('components.admin.settings.roles.edit-role-permissions-modal', ['role' => $role], ['permissions' => $permissions])

                                            <button class="btn-anchor delete-role-button button text-body" data-role-id='{{$role->id}}' href="javascript:">
                                                <i class="ti ti-trash ti-sm me-2"></i>
                                            </button>
                                            @include('components.admin.settings.roles.delete-role-alert', ['role' => $role])

                                        @endif


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
