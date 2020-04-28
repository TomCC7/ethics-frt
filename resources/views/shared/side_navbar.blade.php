<div id="side-navbar" class="sidebar">

  <div id="side-navbar-header" class="flex-column">
    <p> <strong> {{config('app.name')}} </strong> </p>
  </div>

  <ul class="side-navbar-menu">

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
    <a class="side-navbar-link" role="button" data-toggle="collapse"
      href="#answer-sorting" aria-expanded="false" aria-controls="answer-sorting">
      <li class="side-navbar-item dropdown-toggle">Answers</li>
    </a>
    <ul class="collapse side-navbar-menu side-navbar-submenu" id="answer-sorting">
      <a class="side-navbar-link" href="{{ route('answers.index', ["by" => "post"]) }}">
        <li class="side-navbar-item">By Post</li>
      </a>
      <a class="side-navbar-link" href="{{ route('answers.index', ["by" => "user"]) }}">
        <li class="side-navbar-item">By User</li>
      </a>
    </ul>
    @endcan

    @auth
    <a class="side-navbar-link" role="button" data-toggle="collapse"
      href="#user-actions" aria-expanded="false" aria-controls="user-actions">
      <li class="side-navbar-item dropdown-toggle">Hello,
        <strong>{{ Auth::user()->name }}</strong></li>
    </a>
    <ul class="collapse side-navbar-menu side-navbar-submenu" id="user-actions">
      <a class="side-navbar-link" href="{{ route('users.edit', ["user" => Auth::user(), "self_editing" => true]) }}">
        <li class="side-navbar-item">Edit profile</li>
      </a>
      <a class="side-navbar-link" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <li class="side-navbar-item">Logout</li>
      </a>
    </ul>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf
    </form>
    @else
    <li class="side-navbar-item">
      <p style="color:white"> Login to begin. </p>
    </li>
    @endguest

  </ul>
</div>
