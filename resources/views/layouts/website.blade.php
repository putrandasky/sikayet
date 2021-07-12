<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  @yield('meta')
<x-meta></x-meta>
</head>

<body style="background: #eef3f7;">

<div id="app" class="d-flex align-items-end flex-column">

  @yield('content')
</div>
  <script src="{{ mix('/js/app.js') }}"></script>

</body>

</html>
