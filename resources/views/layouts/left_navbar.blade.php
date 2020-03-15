<div class="wrapper">

  <nav id="sidebar">

    <div id="sidebar-header">
       <p> <strong> {{config('app.name')}} </strong> </p>
    </div>

    <ul id="sidebar-menu">

      @auth
      <li> <a href="#">Dashboard</a> </li>
      @endauth

      @auth ('admin')
      <li> <a href="#">Contents</a> </li>
      <li> <a href="#">Users</a> </li>
      <li> <a href="#">Answers</a> </li>
      @endauth

      @auth ('user')
      <li> <a href="#">Posts</a> </li>
      @endauth

      @auth
      <li>
        <a href="#">My Account</a>
        <ul class="sidebar-dropdown">
          <li> <a href="{{route('logout')}}">Logout</a> </li>
        </ul>
      </li>
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
