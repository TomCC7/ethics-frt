<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'NOTITLE') - {{ config('app.name') }}</title>


    <!-- Styles -->
    @yield('styles')
  {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
  <link href="{{ asset('css/mycss.css') }}" rel="stylesheet"> --}}
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>

<div class="container-fluid">
  <div class="row">
    <div class="col-2" id="sidenav">
      @include('layouts.left_navbar')

      @include('shared._messages')
      @include('shared._errors')
    </div>
    <div class="col">
      <div class="row" id='pageHeader'>
        <h1>@yield('pageHeader')</h1>
      </div>
      <div class="row" id="pageContentWrapper">
      @yield('content')
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
@yield('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}
</body>
</html>
