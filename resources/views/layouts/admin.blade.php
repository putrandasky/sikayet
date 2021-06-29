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
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
 <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

  <title>Admin</title>
</head>

<body style="background: #eef3f7;">
<div id="app">

</div>

  <script src="{{ mix('/js/app-admin.js') }}"></script>

</body>

</html>
