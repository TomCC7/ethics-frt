@extends('layouts.app')

@section('title', 'Cluster List')

@section('pageHeader')
Contents
@isset($selectedCluster)
> {{$selectedCluster->name}}
@endisset
@endsection

@section('content')
<div class="row">
  <div class="col-2">
    {{-- Show cluster list on the left --}}

    @can('admin')
    {{-- Only admins can edit clusters --}}
    <div class="row" id="cluster-toolbar">
      <a class="col" href="" data-toggle="modal" data-target="#CreateCluster">Create a new cluster</a>
      <a class="col" href="#">Placeholder</a>
    </div>
    @endcan

    <div class="row">
      <ul id="cluster-list">
        @foreach($clusters as $cluster)
        <li><a href="{{route('clusters.show',$cluster->slug)}}">
            {{$cluster->name}}
            </a>
        </li>
        @endforeach
      </ul>
    </div>
  </div>


@isset($selectedCluster)
{{-- Showing the posts in a cluster --}}
<div class="col">
  @include('posts.index')
</div>
@endisset

</div>

@endsection

@section('modals')
@include('clusters._create_edit')

@isset($selectedCluster)
  @include('clusters._destroy_confirm')
@endisset
@endsection
