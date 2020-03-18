@can('admin')
<div id="post-toolbar">
  <a href="{{route('posts.create')}}"> Create a new post </a>
  <a href="#"> Delete this cluster </a>
</div>
@endcan

<div id="post-list">
  <table id="post-list">
    <tbody>
      @foreach($currentCluster->posts as $post)
      <tr>
        <td class="post-list-item"> <a href="{{route('posts.show',[$currentCluster->slug,$post->slug])}}"> {{$post->title}} </a> </td>
        <td>
          <form method="POST" action="{{route('posts.destroy',$post->slug)}}">
            @csrf
            @method('DELETE')
            <button>Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
