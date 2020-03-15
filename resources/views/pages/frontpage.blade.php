@extends('layouts.app')

@guest @section('title','Welcome')
@else @section('title','Dashboard')
@endguest

@section('content')

  @guest

    @include('auth.login')

  @else

    @include('pages.dashboard')

  @endguest

@endsection
