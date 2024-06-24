<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
          {{ $pretitle ?? '' }}
        </div>
        <h2 class="page-title {{config('tablar.layout') == 'navbar-overlap' ? 'text-white' : ''}}">
          {{ $pagetitle ?? ''}}
        </h2>
        <div class="page-pretitle">
          {{ $posttitle ?? ''}}
        </div>
      </div>
      <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
          @yield('page-title-actions')
        </div>
      </div>

    </div>
  </div>
</div>
