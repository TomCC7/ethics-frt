<div class="wrapper">

  <nav id="sidebar" class="navbar navbar-dark bg-dark documentation-sidebar">

    <div id="sidebar-header" class="navbar-brand flex-column">
      <p> <strong> {{config('app.name')}} </strong> </p>
    </div>

    <ul id="sidebar-menu" class="navbar-nav ml-auto flex-column">

      @auth
      <li class="nav-item"> <a class="nav-link" href="/">Dashboard</a> </li>
      @endauth

      @can ('admin')
      <li class="nav-item"> <a class="nav-link" href="{{route('contents.index')}}">Contents</a> </li>
      <li class="nav-item"> <a class="nav-link" href="{{route('users.index')}}">Users</a> </li>
      <li class="nav-item"> <a class="nav-link" href="{{route('answers.index')}}">Answers</a></li>
      @endcan

      @auth @cannot('admin')
      <li class="nav-item"> <a class="nav-link" href="#">Posts</a> </li>
      @endcan @endauth

      @auth
      <li class="nav-item">
        <a class="nav-link dropdown dropdown-toggle" href="#" data-toggle="dropdown" role="button">Hello,
          <strong>{{ Auth::user()->name }}</strong> </a>
        <ul class="dropdown-menu dropdown-menu-left">
          <li class=" dropdown-item"> <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Logout</a> </li>
        </ul>
      </li>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf
      </form>

      @endauth

      @guest
      <li class="nav-item">
        <p> Login to begin. </p>
      </li>
      @endguest

    </ul>
  </nav>
</div>
