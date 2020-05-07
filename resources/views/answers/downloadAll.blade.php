Your download is started...
@foreach ($post_ids as $post_id)
<iframe src="{{route('answers.download',['type' => 'post','post_id' =>  $post_id])}}" width = '0' height="0" frameborder="no"></iframe>
@endforeach
