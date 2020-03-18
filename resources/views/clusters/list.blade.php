@extends('layouts.app')

@section('title', 'Cluster List')

@section('pageHeader')
Contents
@isset($currentCluster)
> {{$currentCluster->name}}
@endisset
@endsection

@section('content')

<div class="col-2">
  <!-- Show cluster list on the left -->

  @can('admin')
  <!-- Only admins can edit clusters -->
  <div class="row" id="cluster-toolbar">
    <a class="col" href="#">Create a new cluster</a>
    <a class="col" href="#">Placeholder</a>
  </div>
  @endcan

  <div class="row">
    <ul id="cluster-list">
      @foreach($clusters as $cluster)
      <li> <a href="{{route('clusters.show',$cluster->slug)}}">
          {{$cluster->name}}
        </a>
      </li>
      @endforeach
    </ul>
  </div>

</div>

@isset($currentCluster)
<!-- Showing the posts in a cluster -->
<div class="col">
  @include('posts.list')
</div>
@endisset

@endsection
