@php

@endphp
<!-- Edit User Modal -->
<div class="modal fade"  id="editUserModal-{{$user->id}}" tabindex="-1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg modal-simple">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Edit User Information</h3>
          <p class="text-muted">Updating user details will receive a privacy audit.</p>
        </div>
        <form id="editUserForm" class="row g-3" action="{{route('routes.content.admin.users.edit')}}" method="POST">
          @csrf
          <input type="hidden" name="userId" value="{{$user->id}}">
          <div class="col-12 col-md-6">
            <label class="form-label" for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" class="form-control" value="{{$user->first_name}}" />
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" class="form-control" value="{{$user->last_name}}" />
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" value="{{$user->username}}" />
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="display_name">Display Name</label>
            <input type="text" id="display_name" name="display_name" class="form-control" value="{{$user->display_name}}" />
          </div>
          <div class="col-12">
            <label class="form-label" for="email">Email</label>
            <input type="text" id="email" name="email" class="form-control" value="{{$user->email}}" />
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label" for="account_status">Account Status</label>

            <select id="account_status" name="account_status" class="select2 form-select" aria-label="Default select example">
              <option {{$user->account_status == "Active" ? 'selected' : ''}} value="Active">Active</option>
              <option {{$user->account_status == "On Hold" ? 'selected' : ''}} value="On Hold">On Hold</option>
              <option {{$user->account_status == "Disabled" ? 'selected' : ''}} value="Disabled">Disabled</option>
              <option {{$user->account_status == "Banned" ? 'selected' : ''}} value="Banned">Banned</option>
            </select>
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label" for="account_status">Timezone</label>

            <select id="timezone" name="timezone" class="select2 form-select" aria-label="Default select example">
              @foreach(DateTimeZone::listIdentifiers(DateTimeZone::ALL) as $timezone)
                <option {{$user->timezone == $timezone ? 'selected' : ''}} value="{{$timezone}}">{{$timezone}}</option>
              @endforeach


            </select>
          </div>
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
