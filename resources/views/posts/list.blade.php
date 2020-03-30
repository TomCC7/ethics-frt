@can('admin')
<div id="post-toolbar">
  <form action="{{route('contents.destroy',$content->slug)}}" method="POST" id="delete-form">
    @csrf
    @method('DELETE')
    <a href="{{route('posts.create')}}"> Create a new post </a>
    {{-- <a href="" onclick="event.preventDefault(); --}}
    {{-- document.getElementById('delete-form').submit();"> --}}
      {{-- Delete this cluster --}}
    {{-- </a> --}}
    <button type="submit">Delete</button>
  </form>
</div>
@endcan

<div id="post-list">
  <table class="table table-hover" id="post-list">
    <tbody>
      @foreach($content->posts as $post)
      <tr>
        <td class="post-list-item"> <a href="{{route('posts.show',[$content->slug,$post->slug])}}"> {{$post->title}}
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
