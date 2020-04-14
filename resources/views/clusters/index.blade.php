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
    <div id="cluster-toolbar">
      <a href="" type="button" class="btn btn-success" data-toggle="modal"
        data-target="#CreateCluster">Create cluster</a>
    </div>
    @endcan

    <div>
      <table class="table table-hover" id="cluster-list">
        <tbody>
          @foreach($clusters as $cluster)
            <tr><td><a href="{{route('clusters.show',$cluster->slug)}}">
              {{$cluster->name}}
              </a>
            </td></tr>
          @endforeach
        </tbody>
      </table>
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
@endsection
