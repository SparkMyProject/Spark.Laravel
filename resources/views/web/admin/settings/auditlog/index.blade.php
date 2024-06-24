@php
  use App\Models\Authentication\User as User;
@endphp
@extends('tablar::page')

@section('title', 'Audit Log - View')
@section('content')
  <div class="page-wrapper">
    @include('components._partials.page-title', ['pagetitle' => 'Audit Log', 'pretitle' => 'Settings', 'posttitle' => 'View Audit Log'])

    <div class="page-body container-xl card">
      @include('components._partials.alert-handling', ['br' => true])
      <!-- DataTable with Buttons -->
      <div>
        <input type="text" id="auditlog-search" placeholder="Search">
        <div class="card-datatable table-responsive pt-0">
          <table class="datatables-basic table">
            <thead>
            <tr>

              <th>id</th>
              <th>Causing User</th>
              <th>Description</th>
              <th>Affected User</th>
              <th>Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($auditlogs as $auditlog)
              <tr>
                <td>{{ $auditlog->id }}</td>
                <td>{{optional(User::find($auditlog->causer_id))->display_name ? : 'SYSTEM'}}</td>
                <td>{{ $auditlog->description }}</td>
                <td>{{optional(User::find($auditlog->subject_id))->display_name ? : 'SYSTEM'}}</td>
                <td>{{ $auditlog->created_at }}</td>
                <td>{{ $auditlog->status }}</td>
                <td>
                  <a type="button" class="btn btn-sm btn-outline-primary"
                     href={{route('routes.web.admin.settings.auditlog.view', ['id' => $auditlog->id])}}>View</a>
                  <button type="button" class="btn btn-sm btn-outline-danger disabled">Delete</button>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- Modal to add new record -->
      <div class="offcanvas offcanvas-end" id="add-new-record">
        <div class="offcanvas-header border-bottom">
          <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
          <form class="add-new-record pt-0 row g-2" id="form-add-new-record" onsubmit="return false">
            <div class="col-sm-12">
              <label class="form-label" for="basicFullname">Full Name</label>
              <div class="input-group input-group-merge">
                <span id="basicFullname2" class="input-group-text"><i class="ti ti-user"></i></span>
                <input type="text" id="basicFullname" class="form-control dt-full-name" name="basicFullname"
                       placeholder="John Doe" aria-label="John Doe" aria-describedby="basicFullname2"/>
              </div>
            </div>
            <div class="col-sm-12">
              <label class="form-label" for="basicPost">Post</label>
              <div class="input-group input-group-merge">
                <span id="basicPost2" class="input-group-text"><i class='ti ti-briefcase'></i></span>
                <input type="text" id="basicPost" name="basicPost" class="form-control dt-post" placeholder="Web Developer"
                       aria-label="Web Developer" aria-describedby="basicPost2"/>
              </div>
            </div>
            <div class="col-sm-12">
              <label class="form-label" for="basicEmail">Email</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="ti ti-mail"></i></span>
                <input type="text" id="basicEmail" name="basicEmail" class="form-control dt-email"
                       placeholder="john.doe@example.com" aria-label="john.doe@example.com"/>
              </div>
              <div class="form-text">
                You can use letters, numbers & periods
              </div>
            </div>
            <div class="col-sm-12">
              <label class="form-label" for="basicDate">Joining Date</label>
              <div class="input-group input-group-merge">
                <span id="basicDate2" class="input-group-text"><i class='ti ti-calendar'></i></span>
                <input type="text" class="form-control dt-date" id="basicDate" name="basicDate"
                       aria-describedby="basicDate2" placeholder="MM/DD/YYYY" aria-label="MM/DD/YYYY"/>
              </div>
            </div>
            <div class="col-sm-12">
              <label class="form-label" for="basicSalary">Salary</label>
              <div class="input-group input-group-merge">
                <span id="basicSalary2" class="input-group-text"><i class='ti ti-currency-dollar'></i></span>
                <input type="number" id="basicSalary" name="basicSalary" class="form-control dt-salary" placeholder="12000"
                       aria-label="12000" aria-describedby="basicSalary2"/>
              </div>
            </div>
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
              <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
          </form>

        </div>
      </div>
      <!--/ DataTable with Buttons -->
    </div>



    <script>
      $(document).ready(function () {
        var table = $('.datatables-basic').DataTable();

        $('#auditlog-search').on('keyup', function () {
          table.search(this.value).draw();
        });
      });
    </script>
@endsection
