@extends('tablar::page')

@section('title', 'Permissions - View')



@section('content')
  <div class="page-wrapper">
    @include('components/_partials/page-title', ['pagetitle' => 'Permissions - View', 'pretitle' => 'Permissions', 'posttitle' => 'Each category (Basic, Professional, and Business) includes the four predefined roles shown below.'])
    <div class="page-body container-lg card card-lgcard-datatable table-responsive">
      @include('components/_partials/alert-handling', ['br' => true])

      <!-- Permission Table -->
        <table class="datatables-permissions table border-top">
          <thead>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Assigned To</th>
            <th>Created Date</th>
            <th>Actions</th>
          </tr>
          </thead>

          <tbody>
          @foreach($permissions as $permission)
            <tr>
              <td>{{ $permission->name }}</td>
              <td>{{ $permission->description }}</td>
              <td>{{ $permission->roles_count }} Roles, {{$permission->users_count}} Users</td>
              <td>{{ $permission->created_at }}</td>
              <td>
                <a data-bs-toggle="modal" data-bs-target="#editPermissionModal-{{$permission->id}}" href="javascript:"
                   class="text-body">
                  <i class="ti ti-edit ti-sm me-2"></i>
                </a>
                @include('components/admin/settings/permissions/edit-permission-modal', ['permission' => $permission])

                <btn disabled class="" data-bs-toggle="modal"
                     data-bs-target="#deletePermissionModal-{{$permission->id}}">
                  <i class="ti ti-trash ti-sm me-2"></i></btn>

                <a href="{{route('routes.web.admin.settings.permissions.view', ['id' => $permission->id])}}" class="text-body">
                  <i class=" ti ti-eye ti-sm me-2"></i></a>
                {{--              <a href="{{ route('routes.content.admin.settings.permissions.delete', $permission->id) }}" class="btn btn-sm btn-danger">Delete</a>--}}
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
    </div>
  </div>
      <!--/ Permission Table -->

@endsection
