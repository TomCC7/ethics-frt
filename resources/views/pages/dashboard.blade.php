<div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">

            <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}">
                <span data-feather="home"></span>
                Dashboard <span class="sr-only">(current)</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link " href="{{url('chapter/1/section/1')}}">
                <span data-feather="home"></span>
                Study<span class="sr-only"></span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{url('/chooseonesurvey')}}">
                <span data-feather="file"></span>
                Survey
              </a>
            </li>
          </ul>

        </div>
      </nav>


      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

      @section('maincontent')
          <h1 class="h2">Dashboard</h1>
          <a class="nav-link" href="{{url('/changeAgreement')}}">

                Change Register Agreement
          </a>
      @show

      </main>

    </div>
  </div>
