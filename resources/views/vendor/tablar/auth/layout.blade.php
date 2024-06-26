<!doctype html>
<html lang="{{ Config::get('app.locale') }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- CSS files -->
  @if(config('tablar','vite'))
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
  @endif
</head>
<body class=" border-top-wide border-primary d-flex flex-column">
<div class="page page-center">
    @yield('content')
</div>
</body>
</html>
