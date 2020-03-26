{{-- this file shows the content of a post --}}
@extends('layouts.app')

@section('title',$post->title . '-Post')

@section('pageHeader')
Post-<small>{{$post->title}}</small>
<span><a href="{{route('posts.edit',$post->slug)}}"><button class="btn btn-success">Edit</button></a></span>
@endsection

@section('content')
<div id="content">
  <form method="POST" action="{{route('answers.store')}}">
    @csrf
    @each('modules._show', $post->modules, 'module', 'modules._show._empty')
    <button type="submit">Submit answer</button>
  </form>

  <br>

  {{-- Creating --}}
  @include('modules._create')

  </div>
</div>
@endsection

{{-- Render the rich text editor --}}
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('js/module.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/hotkeys.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/uploader.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/simditor.js') }}"></script>

<script>
  $(document).ready(function(){// load when the whole document is loaded
      var editor = new Simditor({
        textarea: $('#editor'),
        upload: {
          url: '{{ route('posts.upload_image') }}',
          params: {
            _token: '{{ csrf_token() }}'
          },
          fileKey: 'upload_file',
          connectionCount: 10,
          leaveConfirm: 'Uploading pictures, please wait'
        },
        pasteImage: true,
      });
});
function SelectForm()
  {
    // getting the variables
    var text_form=document.getElementById("form-create-text");
    var choice_form=document.getElementById("form-create-choice");
    var filling_form=document.getElementById("form-create-filling");
    var select=$('#select-form-select');
    // make all forms hidden
    text_form.className="card d-none";
    choice_form.className="d-none table-responsive";
    filling_form.className="card d-none";
    switch (select.val())
    {
      case "text":
        text_form.className="card";
        break;
      case "choice":
        choice_form.className="table-responsive";
        break;
      case "filling":
        filling_form.className="card";
        break;
      default:
        break;
    }
  }
</script>
@stop
