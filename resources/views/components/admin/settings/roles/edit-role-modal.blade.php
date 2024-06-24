@php

@endphp
<!-- Edit User Modal -->
<div class="modal fade"  id="editRoleModal-{{$role->id}}" tabindex="-1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg modal-simple">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Edit Role Information</h3>
          <p class="text-muted">Updating role details will receive a privacy audit.</p>
        </div>
        <form id="editRoleForm" class="row g-3" action="{{route('routes.web.admin.settings.roles.edit', ['id' => $role->id])}}" method="POST">
          @csrf
{{--          <input type="hidden" name="roleId" value="{{$role->id}}">--}}
          <div class="col-12 col-md-6">
            <label class="form-label" for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{$role->name}}" />
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="description">Description</label>
            <input type="text" id="description" name="description" class="form-control" value="{{$role->description}}" />
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="icon">Icon</label>
            <input type="text" id="icon" name="icon" class="form-control" value="{{$role->icon}}" />
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="html5-number-input">Number</label>
            <input type="number" id="priority" name="priority" class="form-control" value="{{$role->priority}}" />
          </div>


{{--          <div class="col-12 col-md-6">--}}
{{--            <label class="form-label" for="account_status">Account Status</label>--}}

{{--            <select id="account_status" name="account_status" class="select2 form-select" aria-label="Default select example">--}}
{{--              <option {{$user->account_status == "Active" ? 'selected' : ''}} value="Active">Active</option>--}}
{{--              <option {{$user->account_status == "Disabled" ? 'selected' : ''}} value="Disabled">Disabled</option>--}}
{{--              <option {{$user->account_status == "Banned" ? 'selected' : ''}} value="Banned">Banned</option>--}}
{{--            </select>--}}
{{--          </div>--}}

{{--          <div class="col-12 col-md-6">--}}
{{--            <label class="form-label" for="account_status">Timezone</label>--}}

{{--            <select id="timezone" name="timezone" class="select2 form-select" aria-label="Default select example">--}}
{{--              <option {{$user->timezone == "AEST" ? 'selected' : ''}} value="AEST">AEST (Australian Eastern Standard Time)</option>--}}
{{--              <option {{$user->timezone == "CST" ? 'selected' : ''}} value="CST">CST (Central Standard Time)</option>--}}
{{--              <option {{$user->timezone == "EST" ? 'selected' : ''}} value="EST">EST (Eastern Standard Time)</option>--}}
{{--              <option {{$user->timezone == "PST" ? 'selected' : ''}} value="PST">PST (Pacific Standard Time)</option>--}}
{{--              <option {{$user->timezone == "UTC" ? 'selected' : ''}} value="UTC">UTC (Coordinated Universal Time)</option>--}}


{{--            </select>--}}
{{--          </div>--}}
{{--          <div class="col-12 col-md-6">--}}
{{--            <label class="form-label" for="modalEditUserPhone">Phone Number</label>--}}
{{--            <div class="input-group">--}}
{{--              <span class="input-group-text">US (+1)</span>--}}
{{--              <input type="text" id="modalEditUserPhone" name="modalEditUserPhone" class="form-control phone-number-mask" placeholder="202 555 0111" />--}}
{{--            </div>--}}
{{--          </div>--}}


          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--/ Edit User Modal -->
