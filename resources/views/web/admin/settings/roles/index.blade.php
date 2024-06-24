@php
  $configData = Helper::appClasses();
@endphp

@extends('tablar::page')

@section('title', 'Roles - Apps')


@section('content')
  <div class="page-wrapper">
    @section('page-title-actions')
      @csrf
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoleModal">
        Create Role
      </button>
      @include('components.admin.settings.roles.create-role-modal')
    @endsection

    @include('components._partials.page-title', ['pagetitle' => 'Roles', 'pretitle' => 'Settings', 'posttitle' => 'A role provided access to predefined menus and features
    so that depending on an assigned role an
        administrator can have access to what user needs.'])

    <div class="page-body container-xl card">
      @include('components/_partials/alert-handling', ['br' => true])

      <!-- Role cards -->
      <div class="row g-4">
        <div class="col-12">
          <!-- Role Table -->
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
                  <tr class="odd {{$role->is_system ? 'text-danger' : ''}}">
                    <td class="sorting_1">
                      <div class="d-flex justify-content-left align-items-center">
                      <span class="text-truncate d-flex align-items-center">
                        <span class="badge badge-center rounded-pill bg-label-primary me-3 w-px-30 h-px-30">
                          <i class="{{$role->icon}}"></i>
                        </span>
                        {{$role->name . ' ' . ($role->is_system ? '(System)' : '')}}
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

                          <button class="btn-anchor delete-role-button text-body" style="border: none; background: none" data-role-id='{{$role->id}}' href="javascript:">
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
          <!--/ Role Table -->
        </div>
      </div>
      <!--/ Role cards -->
    </div>

  </div>
@endsection
