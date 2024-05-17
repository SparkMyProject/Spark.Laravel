@php

@endphp
<!-- Edit User Modal -->
<div class="modal fade"  id="createRoleModal" tabindex="-1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg modal-simple">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Create Role</h3>
          <p class="text-muted">Creating a role will receive a privacy audit.</p>
        </div>
        <form id="createRoleForm" class="row g-3" action="{{route('routes.content.admin.settings.roles.create')}}" method="POST">
          @csrf
{{--          <input type="hidden" name="roleId" value="{{$role->id}}">--}}
          <div class="col-12 col-md-6">
            <label class="form-label" for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" />
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="description">Description</label>
            <input type="text" id="description" name="description" class="form-control"/>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="icon">Icon</label>
            <input type="text" id="icon" name="icon" class="form-control"/>
          </div>
          <div class="col-12 col-md-6">
            <label for="html5-number-input">Priority</label>
            <input type="number" id="priority" name="priority" class="form-control"/>
          </div>



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
