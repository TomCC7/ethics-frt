@extends('layouts.app')

@section('title', 'Cluster List')

@section('pageHeader')
Contents
@isset($content)
> {{$content->name}}
@endisset
@endsection

@section('content')

<div class="col-2">
  <!-- Show cluster list on the left -->

  @can('admin')
  <!-- Only admins can edit clusters -->
  <div class="row" id="cluster-toolbar">
    <a class="col" href="" data-toggle="modal" data-target="#CreateCluster">Create a new cluster</a>
    <a class="col" href="#">Placeholder</a>
  </div>
  @endcan

  <div class="row">
    <ul id="cluster-list">
      @foreach($clusters as $cluster)
      <li> <a href="{{route('contents.show',$cluster->id)}}">
          {{$cluster->name}}
        </a>
      </li>
      @endforeach
    </ul>
  </div>

</div>

@isset($content)
<!-- Showing the posts in a cluster -->
<div class="col">
  @include('posts.list')
</div>
@endisset

@endsection

@section('modals')
<div class="modal fade" id="CreateCluster" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{route('contents.store')}}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Create a new Cluster</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" name="name" id="name" placeholder="Please fill in the name" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
