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
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>

  <div id="side-navbar-wrapper">
    @include('shared.side_navbar')
  </div>

  <div id="yggdrasil" class="container-fluid">
    <div id="messages-and-errors">
      @include('shared._messages')
      @include('shared._errors')
    </div>

    @auth
    <!-- Do not show header and stylize PCW for login page -->
    <div id='page-header'>
      <h1>@yield('pageHeader')</h1>
    </div>
    @endauth

    @auth <div id="page-content-wrapper"> @endauth
      @guest <div class="row no-gutters"> @endguest
        @yield('content')
      </div>
    </div>

    <!-- Modals -->
    @yield('modals')

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}
</body>

</html>
