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
      <tr>
          <td>
            <a href="{{route('answers.show_by_user',$user->id)}}">{{$user->student_id}}</a>
          </td>
          <td>{{$user->first_name}}</td>
          <td>{{$user->last_name}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
