@extends('layouts.app')

@section('title', 'Answers')

@section('pageHeader', 'Answers by Post')

@section('content')

@foreach ($clusters as $cluster)
<h2>{{$cluster->name}}</h2>
<ul>
  @foreach ($cluster->posts as $post)
  <li><a href="{{route('answers.show_by_post',[$cluster->slug,$post->slug])}}">
      {{$post->title}}
    </a></li>
  @endforeach
</ul>
@endforeach

@endsection
