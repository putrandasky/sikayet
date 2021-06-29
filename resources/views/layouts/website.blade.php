<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  @yield('meta')
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="robots" content="all">
  <meta name="webcrawlers" content="all">
  <meta name="theme-color" content="#041d4c" />
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
  <link rel="manifest" href="{{ asset('images/site.webmanifest') }}">
  <!-- Main Stylesheet File -->
  {{-- <link href="{{ mix('css/app.css') }}" rel="stylesheet"> --}}
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
 <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body style="background: #eef3f7;">

<div id="app" class="d-flex align-items-end flex-column">

  @yield('content')
</div>
  <script src="{{ mix('/js/app.js') }}"></script>

</body>

</html>
