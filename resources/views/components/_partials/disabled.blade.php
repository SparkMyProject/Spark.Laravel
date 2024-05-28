<div>
  @if(Auth::user()->account_status == "Disabled")
  <div>
    <div class="alert alert-warning d-flex align-items-baseline" role="alert">
  <span class="alert-icon alert-icon-lg me-2">
    <i class="ti ti-player-pause ti-sm"></i>
  </span>
      <div class="d-flex flex-column ps-1">
        <p class="mb-0"><span style="font-weight: bold">Alert:</span> Your account has been disabled. Please contact your webmaster.</p>

      </div>
    </div>
  </div>
  @endif


</div>
