<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
  <link rel="manifest" href="{{ asset('images/site.webmanifest') }}">
  <!-- Main Stylesheet File -->
  {{-- <link href="{{ mix('css/app.css') }}" rel="stylesheet"> --}}
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <title>Document</title>
</head>

<body>
  <nav id="main-navbar" class="navbar navbar-expand-sm navbar--ontop fixed-top bg-c-dark px-md-5 shadow">
    <a class="navbar-brand" href="{{url("")}}">
      COMREVAPP
      {{-- <img src="{{ asset('images/icon_signfinger.svg') }}" alt="">
      <img src="{{ asset('images/signfinger.svg') }}" alt=""> --}}
    </a>
    <ul class="navbar-nav ml-auto d-flex">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Contact</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">FAQ</span></a>
      </li>
    </ul>
    <div class="navbar justify-content-end d-none d-md-flex">
      <a class="mr-2 btn btn-primary btn-sm" href="{{url("")}}">Write a Review</a>
      <a class=" btn btn-dark btn-sm " href="{{url("/id")}}">For Companies</a>
    </div>
    <ul class="nav justify-content-end d-flex d-md-none">
      <button type="button" class="btn btn-primary btn-sm">
        Write a Review
      </button>
      <button type="button" class="btn btn-dark btn-sm">
        For Companies
      </button>
    </ul>
  </nav>
  @yield('content')
</body>

</html>
