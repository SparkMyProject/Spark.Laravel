@extends('tablar::page')

@section('title', 'Dashboard')

@section('content')

  <div class="page-wrapper">
    @include('components._partials.page-title', ['pagetitle' => 'Dashboard', 'pretitle' => 'Dashboard'])
    <div class="page-body container-lg text-white">
      <h1 class="text-center">Welcome, {{ Auth::user()->username }}</h1>
    </div>

  </div>



@endsection
