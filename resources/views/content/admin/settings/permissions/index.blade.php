@extends('components/layouts/layoutMaster')

@section('title', 'Permission - Apps')

@section('vendor-style')
  @vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
    'resources/assets/vendor/libs/@form-validation/form-validation.scss',
  ])
@endsection

@section('vendor-script')
  @vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js',
    ])
@endsection


@section('content')
  <h4 class="mb-4">Permissions List</h4>

  <p class="mb-4">Each category (Basic, Professional, and Business) includes the four predefined roles shown below.</p>


  <!-- Permission Table -->
  <div class="card">
    <div class="card-datatable table-responsive">
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
            <td>{{ $permission->assigned_to }}</td>
            <td>{{ $permission->created_at }}</td>
            <td>
{{--              <a href="{{ route('routes.content.admin.settings.permissions.edit', $permission->id) }}" class="btn btn-sm btn-primary">Edit</a>--}}
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
