@extends('layouts.app')

@section('title','Cluster List')

@section('content')

<div class="row">
  <div class="col-2">

    @can('admin') <!-- Only admins can edit clusters -->
    <div class="container" id="cluster-toolbar">
      <div class="row">
        <a class="col" href="#">Create a new cluster</a>
        <a class="col" href="#">What else can I do?</a>
      </div>
    </div>
    @endcan

    <ul id="cluster-list">
      @foreach($clusters as $cluster)
      <li> <a href=" {{
            route('post-list',['clusterID' => $cluster->id])
            }}">
            {{$cluster->name}}
          </a> </li>
      @endforeach
    </ul>

  </div>

  <div class="col">
    @include('posts.list')
  </div>

</div>

@endsection
