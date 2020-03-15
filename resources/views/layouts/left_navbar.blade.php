<div class="wrapper">

  <nav id="sidebar">

    <div id="sidebar-header">
       <p> <strong> {{config('app.name')}} </strong> </p>
    </div>

    <ul id="sidebar-menu">

      @auth
      <li> <a href="#">Dashboard</a> </li>
      @endauth

      @can ('admin')
      <li> <a href="#">Contents</a> </li>
      <li> <a href="#">Users</a> </li>
      <li> <a href="#">Answers</a> </li>
      @endcan

      @cannot ('admin')
      <li> <a href="#">Posts</a> </li>
      @endcan

      @auth
      <li>
        <a href="#">My Account</a>
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
        <a href="{{route('login')}}">Login</a>
        <ul class="sidebar-dropdown">
          <li> <a href="{{route('register')}}">Register</a> </li>
        </ul>
      </li>
      @endguest

    </ul>
  </nav>
</div>
