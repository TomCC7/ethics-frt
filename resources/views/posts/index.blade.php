@can('admin')
<div id="post-toolbar">
  <a href="#create-post" data-toggle="modal"> Create a new post here </a>
  <a href="#delete-cluster" data-toggle="modal">Delete this cluster</a>
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
          <form method="POST" action="{{route('posts.destroy',$post->slug)}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@include('posts._create')
