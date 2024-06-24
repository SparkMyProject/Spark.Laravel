@extends('tablar::page')

@section('title', 'Dashboard')

@section('content')

  <div>
    <h1 class="text-center">Welcome, {{ Auth::user()->username }}</h1>
  </div>

@endsection
