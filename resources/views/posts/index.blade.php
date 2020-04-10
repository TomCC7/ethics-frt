@can('admin')
<div id="post-toolbar">
  <a href="#create-post" type="button" class="btn btn-success" data-toggle="modal">Create post</a>
  <a href="#delete-cluster" type="button" class="btn btn-danger" data-toggle="modal">Delete this cluster</a>
  </form>
</div>
@endcan

<div id="post-list">
  <table class="table table-hover" id="post-list">
    <tbody>
      @foreach($selectedCluster->posts as $post)
      <tr>
        <td class="post-list-item"> <a href="{{route('posts.show',['cluster'=>$selectedCluster->slug,'post'=>$post->slug])}}">
            {{$post->title}}
          </a> </td>
        <td>
          @can('admin')
            <form method="POST" action="{{route('posts.destroy',$post->slug)}}">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          @endcan
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@include('posts._create')
