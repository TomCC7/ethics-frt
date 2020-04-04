{{-- this file shows the content of a post --}}
@extends('layouts.app')

@section('title',$post->title . '-Post')

@section('pageHeader')
Post-<small>{{$post->title}}</small>
<span><button class="btn btn-success" data-toggle="modal" data-target="#edit-post">Edit</button></span>
@endsection

@section('content')
<div id="content">
  @cannot('admin')
  <form method="POST" action="{{route('answers.store')}}">
    @csrf
    <input type="hidden" name="post_id" value="{{$post->id}}">
    @endcannot

    @foreach ($post->modules as $module)
    @include('modules._show._show')
    @endforeach

    {{-- Can't be seen by admin --}}
    @cannot('admin')
    {{-- Only can be seen when there's question --}}
    @if ($post->modules()->question()->first())

    @if($answer_record)
    <button type="submit" class="btn btn-secondary"
      onclick="return confirm('Are you sure you want to resubmit your answer?');">
      Resubmit answer
    </button>
    <span class="d:inline">You've submitted your answer at
      {{$answer_record->updated_at}}!</span>
    @else
    <button type="submit" class="btn btn-primary">
      Submit answer
    </button>
    @endif

    @endif
  </form>
  @endcannot

  {{-- Creating --}}
  @can('admin')
  <span><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-form-select">
      Create a new module
    </button></span>
  @endcan
</div>
</div>
@endsection

@section('modals')
@include('modules._create._create')
@include('posts._edit')
@endsection

{{-- Render the rich text editor --}}
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
@endsection

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
@endsection
