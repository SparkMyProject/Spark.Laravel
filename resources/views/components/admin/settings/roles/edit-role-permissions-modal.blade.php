<!-- Edit User Modal -->
<div class="modal fade" id="editRolePermissionsModal-{{$role->id}}" tabindex="-1" aria-hidden="true"
     data-backdrop="static">
  <div class="modal-dialog modal-lg modal-simple">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Edit User Information</h3>
          <p class="text-muted">Updating user details will receive a privacy audit.</p>
        </div>
        <form id="editRolePermissionsForm" class="row g-3"
              action="{{route('routes.content.admin.settings.roles.edit-permissions', ['id' => $role->id])}}"
              method="POST">
          @csrf
          <input type="hidden" name="roleId" value="{{$role->id}}">
          @foreach($permissions as $permission)
            <div class="form-check mt-3">
              <input class="form-check-input" type="checkbox" name="permissions[]" value="{{$permission->name}}"
                     {{$role->hasPermissionTo($permission->name) ? 'checked' : ''}} id="defaultCheck{{$permission->id}}" />
              <label class="form-check-label" for="defaultCheck{{$permission->id}}">
                {{$permission->name}}
              </label>
            </div>
          @endforeach
          {{--          <div class="col-12 col-md-6">--}}
          {{--            <label class="form-label" for="modalEditUserPhone">Phone Number</label>--}}
          {{--            <div class="input-group">--}}
          {{--              <span class="input-group-text">US (+1)</span>--}}
          {{--              <input type="text" id="modalEditUserPhone" name="modalEditUserPhone" class="form-control phone-number-mask" placeholder="202 555 0111" />--}}
          {{--            </div>--}}
          {{--          </div>--}}


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
