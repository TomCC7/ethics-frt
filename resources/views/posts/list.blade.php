<ul id="post-list">
  @isset($posts)
  @foreach($posts as $post)
  <li class="post-list-item"> <a href="#"> {{$post->title}} </a> </li>
  @endforeach
  @endisset
</ul>
