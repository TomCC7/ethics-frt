@extends('clusters.list')

@section('post-list')

<ul id="post-list">
  @foreach($posts as $post)
  <li class="post-list-item"> <a href="#"> {{$post->name}} </a> </li>
  @endforeach
</ul>
