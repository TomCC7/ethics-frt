@extends('layouts.app')

@section('title', 'Answers')

@section('pageHeader')
<div class="float-left">
  Answers by Post
</div>
<div class="float-right">
  <a href="{{route('answers.downloadAll')}}" class="btn btn-success" role="button">
    Download All
  </a>
</div>
@endsection

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
