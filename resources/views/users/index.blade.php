@extends('layouts.app')

@section('title','List of Users')

@section('pageHeader')
Users
{{-- search bar --}}
<div id="search-bar" class="d-inline-block">
  <form action="{{route('users.search')}}" method="GET">
    <div class="form-inline">
      <input type="text" class="form-control" name="index" placeholder="Search for users" required>
      <button type="submit" class="btn btn-info">
        Search
      </button>
    </div>
  </form>
</div>
@endsection

@section('content')
<div name='content'>
  <table class="table table-hover">
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
      @each('users._info', $users, 'user')
      {{-- equivalent to: --}}
      {{-- @foreach ($users as $user) --}}
      {{-- @include('users._info') --}}
      {{-- @endforeach --}}
    </tbody>
  </table>
  {{-- paginate --}}
  <div>
    <div id='render_page' class="paginator">
      {!! $users->render() !!}
    </div>
  </div>
</div>

@endsection
