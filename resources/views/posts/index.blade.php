<div class="card">
  <div class="card-header">
    <div class="float-left">
      <ul class="nav nav-pills card-header-pills">
        <li class="nav-item">
          <a class="nav-link {{is_selected('released',$_GET['status'],'active')}}"
            href="{{route('clusters.show',['cluster' => $selectedCluster->slug,'status' => 'released'])}}">Released</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{is_selected('archived',$_GET['status'],'active')}}"
            href="{{route('clusters.show',['cluster' => $selectedCluster->slug,'status' => 'archived'])}}">Archived</a>
        </li>
        @can('admin')
        <li class="nav-item">
          <a class="nav-link {{is_selected('unreleased',$_GET['status'],'active')}}"
            href="{{route('clusters.show',['cluster' => $selectedCluster->slug,'status' => 'unreleased'])}}">Unreleased</a>
        </li>
        @endcan
      </ul>
    </div>
    <div class="float-right">
      <a role="button" type="button" class="btn btn-success" data-toggle="modal" data-target="#create-post">Create
        post</a>
      <a role="button" type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-cluster">Delete
        this cluster</a>
    </div>
  </div>
  <div class="card-body">
    <ul class="list-group list-group-flush">
      @if(isset($posts[$_GET['status']]))
      @foreach ($posts[$_GET['status']] as $post)
      <li class="list-group-item">
        <a class="float-left text-decoration-none"
          href="{{route('posts.show',[$post->cluster->slug,$post->slug])}}">{{$post->title}}</a>
        @can('admin')
        <form method="POST" action="{{route('posts.destroy',$post->slug)}}" class="float-right"
          onsubmit="return confirm('Delete post {{$post->title}}?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        @endcan
      </li>
      @endforeach
      @else
      <li class="list-group-item">No Content!</li>
      @endif
    </ul>
  </div>
</div>

@section('modals')
@parent
@include('posts._create')
@include('clusters._destroy_confirm')
@endsection
