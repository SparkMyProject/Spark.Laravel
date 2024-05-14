<!-- Edit User Modal -->
<div class="modal fade" id="editUserRolesModal-{{$user->id}}" tabindex="-1" aria-hidden="true"
     data-backdrop="static">
  <div class="modal-dialog modal-lg modal-simple">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Edit User's Roles</h3>
          <p class="text-muted">Updating user's roles will receive a privacy audit.</p>
        </div>
        <form id="editUserRolesForm" class="row g-3"
              action="{{route('routes.content.admin.users.edit-roles', ['id' => $user->id])}}"
              method="POST">
          @csrf
          <input type="hidden" name="userId" value="{{$user->id}}">
          @foreach($roles as $role)
            <div class="form-check mt-3">
              <input class="form-check-input" type="checkbox" name="roles[]" value="{{$role->id}}"
                     {{$user->hasRole($role) ? 'checked' : ''}} {{$role->is_system ? '' : ''}} id="defaultCheck{{$role->id}}" />
              <label class="form-check-label" for="defaultCheck{{$role->id}}">
                {{$role->name}}
              </label>
            </div>
          @endforeach
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
<!--/ Edit User Modal -->
