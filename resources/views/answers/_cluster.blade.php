<h2>{{$cluster->name}}</h2>
<ul>
  @foreach ($cluster->posts as $post)
  <li><a href="{{route('answers.show',[$cluster->id,$post->id])}}">
      {{$post->title}}
  </a></li>
  @endforeach
</ul>
