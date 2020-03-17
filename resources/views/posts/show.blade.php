{{-- this file shows the content of a post --}}
@extends('layouts.app')

@section('title',$post->title . '-Post')

@section('pageHeader','Post: ' . $post->title)

@section('content')

@foreach ($post->modules as $module)
@include('modules._show')
@endforeach

@endsection
