@php
  $currentUser = Auth::user();
@endphp
@extends('tablar::page')

@section('title', 'User View - Pages')



@section('content')
  <div class="page-wrapper">
    @include('components._partials.page-title', ['pagetitle' => 'User View', 'pretitle' => 'User', 'posttitle' => 'View user details.'])

    <div class="page-body container-xl">
      <div class="row">

        <!-- User Sidebar -->
        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
          <!-- User Card -->
          <div class="card mb-4">
            <div class="card-body">
              @include('components._partials.alert-handling')
              <div class="user-avatar-section">
                <div class=" d-flex align-items-center flex-column">
                  <img class="img-fluid rounded-circle mb-3 pt-1 mt-4" src="{{ $user->profile_photo_url }}" height="100"
                       width="100" alt="User avatar" />
                  <div class="user-info text-center">

                    <h4 class="mb-2">{{$user->display_name ? : $user->username}}</h4>
                    <p class="mb-0 text-muted">{{$user->status}}</p>
                    <span class="badge bg-label-secondary mt-1">{{$user->roles->first()->name}}</span>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-4 border-bottom">
                <div class="d-flex align-items-start me-4 mt-3 gap-2">
                  <span class="badge bg-label-primary p-2 rounded"><i class='ti ti-checkbox ti-sm'></i></span>
                  <div>
                    <p class="mb-0 fw-medium">1.23k</p>
                    <small>Stat 1</small>
                  </div>
                </div>
                <div class="d-flex align-items-start mt-3 gap-2">
                  <span class="badge bg-label-primary p-2 rounded"><i class='ti ti-briefcase ti-sm'></i></span>
                  <div>
                    <p class="mb-0 fw-medium">568</p>
                    <small>Stat 2</small>
                  </div>
                </div>
              </div>
              <p class="mt-4 small text-uppercase text-muted">Details</p>
              <div class="info-container">
                <ul class="list-unstyled">
                  <li class="mb-2">
                    <span class="fw-medium me-1">Username:</span>
                    <span>{{$user->username}}</span>
                  </li>
                  <li class="mb-2">
                    <span class="fw-medium me-1">Display Name:</span>
                    <span>{{$user->display_name ? : 'N/A'}}</span>
                  </li>
                  <li class="mb-2">
                    <span class="fw-medium me-1">Full Name:</span>
                    <span>{{$user->full_name ? : 'N/A'}}</span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Email:</span>
                    <span>{{$user->email ? : 'N/A'}}</span>
                  </li>
                  <li class="mb-2 pt-1">
                    <span class="fw-medium me-1">Account Status:</span>
                    <span class="badge bg-label-{{$user->account_status == "Active" ? 'success' : (($user->account_status == 'Disabled') ? 'warning' : ($user->account_status == 'Banned' ? 'danger' : ''))}}">{{$user->account_status}}</span>
                  </li>
                  <li class="pt-1">
                    <span class="fw-medium me-1">Timezone:</span>
                    <span>{{$user->timezone}}</span>
                  </li>
                </ul>
                <div class="d-flex justify-content-center">
                  <a href="javascript:" class="btn btn-primary me-3"  data-bs-toggle="modal" data-bs-target="#editUserModal-{{$user->id}}">Edit</a>
                  @include('components.admin.users.edit-user-modal', ['user' => $user])
                </div>

              </div>
            </div>
          </div>
          <!-- /User Card -->
          <!-- Plan Card -->
          <div class="card mb-4">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <span class="badge bg-label-primary">Standard</span>
                <div class="d-flex justify-content-center">
                  <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary fw-normal">$</sup>
                  <h1 class="mb-0 text-primary">99</h1>
                  <sub class="h6 pricing-duration mt-auto mb-2 text-muted fw-normal">/month</sub>
                </div>
              </div>
              <ul class="ps-3 g-2 my-3">
                <li class="mb-2">10 Users</li>
                <li class="mb-2">Up to 10 GB storage</li>
                <li>Basic Support</li>
              </ul>
              <div class="d-flex justify-content-between align-items-center mb-1 fw-medium text-heading">
                <span>Days</span>
                <span>65% Completed</span>
              </div>
              <div class="progress mb-1" style="height: 8px;">
                <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0"
                     aria-valuemax="100"></div>
              </div>
              <span>4 days remaining</span>
              <div class="d-grid w-100 mt-4">
                <button class="btn btn-primary" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Upgrade Plan
                </button>
              </div>
            </div>
          </div>
          <!-- /Plan Card -->
        </div>
        <!--/ User Sidebar -->


        <!-- User Content -->
        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">


          <!-- Project table -->


          <!-- Activity Timeline -->
          <div class="card mb-4">
            <h5 class="card-header">User Activity Timeline</h5>
            <div class="card-body pb-0">
              <ul class="timeline mb-0">
                @foreach($user->timeline->events as $event)
                  <li class="timeline-item timeline-item-transparent border-transparent">
                    <span class="timeline-point timeline-point-{{$event->color}}"></span>
                    <div class="timeline-event">
                      <div class="timeline-header mb-1">
                        <h6 class="mb-0">{{$event->title}}</h6>
                        <small class="text-muted">{{$event->created_at->inUserTimezone()}}</small>
                      </div>
                      <p class="mb-0">{{$event->description}}</p>
                    </div>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
          <!-- /Activity Timeline -->
        </div>
        <!--/ User Content -->
      </div>
    </div>
  </div>


  {{--  <!-- Modal -->--}}
  {{--  @include('_partials/_modals/modal-edit-user')--}}
  {{--  @include('_partials/_modals/modal-upgrade-plan')--}}
  {{--  <!-- /Modal -->--}}
@endsection
