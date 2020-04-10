@extends('layouts.app')

@section('title', 'Answers')

@section('pageHeader', 'Answers collected')

@section('content')
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Student ID</th>
      <th>First Name</th>
      <th>Last Name</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <a href="{{route('answers.user',$user->id)}}">
      <tr>
        <td>{{$user->student_id}}</td>
        <td>{{$user->first_name}}</td>
        <td>{{$user->last_name}}</td>
      </tr>
    </a>
    @endforeach
  </tbody>
</table>
@endsection
