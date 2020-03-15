@extends('layouts.app')

@section('title','Dashboard')

@section('content')
  <h1>Dashboard</h1>
    <a href="{{url('/changeAgreement')}}">
      Change Register Agreement
    </a>
@endsection
