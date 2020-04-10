@extends('layouts.app')

@section('title', 'Answers')

@section('pageHeader', 'Answers collected')

@section('content')

@foreach ($clusters as $cluster)
<h2>{{$cluster->name}}</h2>
<ul>
  @foreach ($cluster->posts as $post)
  <li><a href="{{route('answers.show',[$cluster->slug,$post->slug])}}">
      {{$post->title}}
    </a></li>
  @endforeach
</ul>
@endforeach

@endsection
