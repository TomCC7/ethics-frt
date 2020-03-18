<div class="wrapper">

  <nav id="sidebar">

    <div id="sidebar-header">
       <p> <strong> {{config('app.name')}} </strong> </p>
    </div>

    <ul id="sidebar-menu">

      @auth
      <li> <a href="/">Dashboard</a> </li>
      @endauth

      @can ('admin')
      <li> <a href="{{route('clusters.index')}}">Contents</a> </li>
      <li> <a href="{{route('users.index')}}">Users</a> </li>
      @endcan

      @auth @cannot('admin')
      <li> <a href="#">Posts</a> </li>
      @endcan @endauth

      @auth
      <li>
        <a href="#">Hello, <strong>{{ Auth::user()->name }}</strong> </a>
        <ul class="sidebar-dropdown">
          <li> <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a> </li>
        </ul>
      </li>

      <form id="logout-form" action="{{ route('logout') }}" method="POST"
        style="display: none;">{{ csrf_field() }}</form>

      @endauth

      @guest
      <li>
        <p> Login to begin. </p>
      </li>
      @endguest

    </ul>
  </nav>
</div>
