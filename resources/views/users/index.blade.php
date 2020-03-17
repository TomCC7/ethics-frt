@extends('layouts.app')

@section('title','List of Users')

@section('pageHeader')
Users
@endsection

@section('content')
<div name='content'>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Username</th>
        <th>Email</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Student ID</th>
        <th> </th>
        <th> </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      @include('users._info')
      @endforeach
    </tbody>
  </table>
  {{-- paginate --}}
  <div name='render_page'>
    {!! $users->render() !!}
  </div>
</div>

@endsection
