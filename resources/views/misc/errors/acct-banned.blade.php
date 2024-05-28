@php
  $customizerHidden = 'customizer-hide';
  $configData = Helper::appClasses();
@endphp

@extends('components.layouts.blankLayout')

@section('title', 'Not Authorized - Pages')

@section('page-style')
  <!-- Page -->
  @vite(['resources/assets/vendor/scss/pages/page-misc.scss'])
@endsection


@section('content')
  <!-- Not Authorized -->
  <div class="container-xxl container-p-y">
    <div class="misc-wrapper">
      <h2 class="mb-1 mx-2">You're account has been banned.</h2>
      <p class="mb-4 mx-2">The account you've signed in with has been banned. <br> Please contact the administrators for more information.
      </p>
      <a href="{{url('/')}}" class="btn btn-primary mb-4">Back to home</a>
      <div class="mt-4">
        <img src="{{ asset('assets/img/illustrations/page-misc-you-are-not-authorized.png') }}" alt="page-misc-not-authorized" width="170" class="img-fluid">
      </div>
    </div>
  </div>
  <div class="container-fluid misc-bg-wrapper">
    <img src="{{ asset('assets/img/illustrations/bg-shape-image-'.$configData['style'].'.png') }}" alt="page-misc-not-authorized"
         data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png">
  </div>
  <!-- /Not Authorized -->
@endsection