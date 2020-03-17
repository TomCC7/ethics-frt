@can('admin')
  <div id="post-toolbar">
    <a href="#"> Create a new post </a>
    <a href="#"> Delete this cluster </a>
  </div>
@endcan

<div id="post-list">
  <ul id="post-list">
    @foreach($currentCluster->posts as $post)
    <li class="post-list-item"> <a href="#"> {{$post->title}} </a> </li>
    @endforeach
  </ul>
</div>
