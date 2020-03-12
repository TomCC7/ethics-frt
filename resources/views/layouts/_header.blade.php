<nav class="navbar navbar-expand-lg navbar-dark bg-dark flex-md-nowrap p-0 shadow navbar-static-top">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <a class="navbar-brand col-sm-3 col-md-3 " href="{{ route('root') }}">Global Applied Ethics</a>
    </div>
    <div class="mx-auto order-0">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    @guest
                    @else
                    User
                    @endguest
                </a>
            </li>
        </ul>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            @guest
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            @else

            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle col-sm-3 col-md-3 mr-0" href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('users.edit',Auth::id())}}">
                        <form class="btn" id="edit-form" action="#" method="GET">
                        Edit Profile
                        </form>
                    </a>

                    <a class="dropdown-item" href="">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            {{ csrf_field() }}
                            <button class="btn" type="submit" name="logout">Logout</button>
                        </form>
                    </a>
                </div>
            </li>
            @endguest
        </ul>
    </div>
</nav>
<br>
