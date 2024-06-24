@extends('tablar::page')


@section('content')
  <div class="page-wrapper">
    @include('components/_partials/page-title', ['pagetitle' => 'Permissions - View', 'pretitle' => 'Permissions'])
    <div class="page-body container-lg card card-lg">
      <br>
      <h4>Name: {{$permission->name}}</h4>
      <h4>Date: {{$permission->created_at}}</h4>
      <h4>Updated: {{$permission->updated_at}}</h4>
      <h4>Roles Count: {{$permission->roles_count}}</h4>
      <h4>Users Count: {{$permission->users_count}}</h4>
      <h5>Description: {{$permission->description}}</h5>
      <div class="card">
        <h5 class="card-header">Roles Assigned</h5>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
            <tr>
              <th>Role Name</th>
              <th>Role Description</th>
              <th>Role Size</th>
              {{--          @foreach($keys as $key)--}}
              {{--            <th>{{$key}}</th>--}}
              {{--          @endforeach--}}
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">

            @foreach($permission->roles as $role)
              <tr>
                <td>{{$role->name}}</td>
                <td>{{$role->description}}</td>
                <td>{{$role->users_count}}</td>
              </tr>
            @endforeach

            </tbody>
          </table>
        </div>
      </div>
      <br>
      <div class="card">
        <h5 class="card-header">Users Assigned</h5>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
            <tr>
              <th>Username</th>
              <th>Highest Role</th>
              <th>User Status</th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">

            @foreach($permission->users as $user)
              <tr>
                <td>{{$user->username}}</td>
                <td>{{$user->roles->first()->name}}</td>
                <td>              <span class="text-truncate d-flex align-items-center">
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
              </span></td>
                {{--            @foreach($keys as $key)--}}
                {{--              <td>{{$user->$key}}</td>--}}
                {{--            @endforeach--}}
              </tr>
            @endforeach

            </tbody>
          </table>
        </div>
      </div>
      <br>
    </div>
  </div>
@endsection
