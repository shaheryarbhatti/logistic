<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="api-base-url" content="{{ url('/') }}" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <!-- Vendor Stylesheets -->
  <link rel="stylesheet" href="{{url('public/frontend/assets/css/bootstrap.min.css')}}">

</head>

<body>


      <div id="app">
        <index></index>
      </div>


      <!-- Vendor Scripts -->
      <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'}</script>
      <script src="{{url('public/frontend/assets/js/jquery-3.4.1.min.js')}}"></script>
      <script src="{{url('public/frontend/assets/js/bootstrap.min.js')}}"></script>
      <script src="{{url('public/js/app.js')}}" type="text/javascript"></script>

    </body>

    </html>
