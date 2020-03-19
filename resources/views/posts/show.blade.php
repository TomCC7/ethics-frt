{{-- this file shows the content of a post --}}
@extends('layouts.app')

@section('title',$post->title . '-Post')

@section('pageHeader','Post: ' . $post->title)

@section('content')

<form method="POST" action="{{route('answers.store')}}">
  @csrf
  @each('modules._show', $post->modules, 'module', 'modules._show._empty')
  <button type="submit">Submit answer</button>
</form>
@endsection
