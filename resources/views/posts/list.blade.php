@can('admin')
<div id="post-toolbar">
  <form action="{{route('contents.destroy',$content->id)}}" method="POST" id="delete-form">
    @csrf
    @method('DELETE')
    <a href="{{route('posts.create')}}"> Create a new post </a>
    <a href="" onclick="event.preventDefault();
    document.getElementById('delete-form').submit();">
      Delete this cluster
    </a>
  </form>
</div>
@endcan

<div id="post-list">
  <table class="table table-hover" id="post-list">
    <tbody>
      @foreach($content->posts as $post)
      <tr>
        <td class="post-list-item"> <a href="{{route('posts.show',['cluster'=>$content->id,'post'=>$post->id])}}">
            {{$post->title}}
          </a> </td>
        <td>
          <form method="POST" action="{{route('posts.destroy',$post->id)}}">
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
