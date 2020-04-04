<div id="side-navbar" class="sidebar">

  <div id="side-navbar-header" class="flex-column">
    <p> <strong> {{config('app.name')}} </strong> </p>
  </div>

  <ul id="side-navbar-menu" class="menu">

    @auth
    <a class="side-navbar-link" href="/">
      <li class="side-navbar-item"> Dashboard </li>
    </a>
    <a class="side-navbar-link" href="{{route('contents.index')}}">
      <li class="side-navbar-item">Contents </li>
    </a>
    @endauth

    @can('admin')
    <a class="side-navbar-link" href="{{route('users.index')}}">
      <li class="side-navbar-item">Users</li>
    </a>
    <a class="side-navbar-link" href="{{route('answers.index')}}">
      <li class="side-navbar-item">Answers</li>
    </a>
    @endcan

    @auth
    <div class="dropdown">
      <a class="side-navbar-link dropdown" role="button" data-toggle="dropdown" href="#">
        <li class="side-navbar-item dropdown-toggle">Hello,
          <strong>{{ Auth::user()->name }}</strong></li>
      </a>
      <ul class="dropdown-menu dropdown-menu-left">
        <a class="side-navbar-link" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <li class="side-navbar-item">Logout</li>
        </a>
      </ul>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf
    </form>
    @else
    <li class="side-navbar-item">
      <p style="color:white"> Login to begin. </p>
    </li>
    @endguest

  </ul>
</div>
