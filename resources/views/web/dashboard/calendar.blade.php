@extends('components/layouts/layoutMaster')

@section('title', 'Fullcalendar - Apps')

@section('vendor-style')
@vite([
'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
'resources/assets/vendor/libs/select2/select2.scss',
'resources/assets/vendor/libs/quill/editor.scss',
'resources/assets/vendor/libs/@form-validation/form-validation.scss',
])
@endsection

@section('page-style')
@vite(['resources/assets/vendor/scss/pages/app-calendar.scss'])
@endsection

@section('vendor-script')
@vite([
'resources/assets/vendor/libs/fullcalendar/fullcalendar.js',
'resources/assets/vendor/libs/@form-validation/popular.js',
'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
'resources/assets/vendor/libs/@form-validation/auto-focus.js',
'resources/assets/vendor/libs/select2/select2.js',
'resources/assets/vendor/libs/flatpickr/flatpickr.js',
'resources/assets/vendor/libs/moment/moment.js',
])
@endsection

@section('page-script')
@vite([
//'resources/assets/js/app-calendar-events.js',
//'resources/assets/js/app-calendar.js',
])
@endsection

@section('content')
  <div>
    @livewire('dashboard.calendar-component')
  </div>

  <script>
    {{--window.events = {!! json_encode($events) !!};--}}
  </script>
@endsection

