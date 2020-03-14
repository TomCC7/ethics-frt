@extends('layouts.app')

@section('title','List of Users')

@section('content')
<ul>
  @foreach ($users as $user)
  @include('users._info')
  @endforeach
</ul>
@endsection
