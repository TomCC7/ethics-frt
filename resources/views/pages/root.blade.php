@extends('layouts.app')

@section('title','Description')

@section('content')

@guest

@include('pages.description')

@else

@include('pages.dashboard')

@endguest

@endsection
