@extends('layouts.app')

@section('content')

@guest

<div class="container vertical-center">
  <main role="main" class="inner cover">

    <div class="text-center">
    <h1 class="cover-heading">Global Applied Ethics</h1>
    <p class="lead">This site hosts content and collects information related to applied ethics and moral psychology</p>
    </div>

    <div>
        @php
        $link_login = url('/login');
        $link_register = url('/register');
        $link_umji = "http://umji.sjtu.edu.cn";
        $link_book = "https://www.elsevier.com/books/global-engineering-ethics/luegenbiehl/978-0-12-811218-2";
        @endphp

        <p>It is the result of interdisciplinary education and research efforts by faculty members, administrators, and students in philosophy, computer science, social psychology, mathematics, and international education at the <a href = {{$link_umji}}>University of Michigan-Shanghai Jiao Tong University Joint Institute</a>, and Institute of Social Cognitive and Behavioral Science, Shanghai Jiao Tong University.</p>
        <p>Scandals involving ethics within engineering, business, and medicine negatively affect members of the public, corporations, and governments. Effective ethics training is necessary to address these problems, as well as to raising the reputations of individuals, organizations, and institutions that value ethics and engage in ethical behaviors. To do so, this site provides educational materials on applied ethics, as well as collects information regarding what people think is right and wrong and why, to further develop ethics curricula and contribute to the development of character and perspectives crucial to international leadership, professionalism, and citizenry. </p>
        <p>Potential partners in education and industry are encouraged to contact Rockwell Clancy regarding the possibility of using this site in courses, corporate, or professional training: <a href="mailto:rockwell.clancy@sjtu.edu.cn">rockwell.clancy@sjtu.edu.cn</a></p>
        <p>The educational modules included herein are based on materials abridged from <a href = {{$link_book}}><i>Global Engineering Ethics</i></a>, used with the permission of the authors and Elsevier Press. These should not be reproduced without the permission of the authors, Heinz Luegenbiehl and Rockwell Clancy: <a href="mailto:rockwell.clancy@sjtu.edu.cn">rockwell.clancy@sjtu.edu.cn</a>.</p>
    <p class="lead text-right">
      <a href="#" class="btn btn-lg btn-secondary">Learn more</a>
    </p>
  </div>
  </main>
</div>

@else

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

@endguest

@endsection
