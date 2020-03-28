{{-- Edit a module --}}
@extends('layouts.app')

@section('title','EditModule')

@section('content')
<form class="form" method="POST" action="{{route('modules.update',$module->id)}}">
  @csrf
  @method('PATCH')
  {{-- Post id --}}
  <input type="hidden" name="post_id" value="{{$post->id}}">
  @switch($module->type)
    @case('text')
      @include('modules._edit._text')
      @break
    @case('filling')
      @include('modules._edit._filling')
      @break
    @case('single-choice')
      {{-- no break --}}
    @case('multiple-choice')
      @include('modules._edit._choice')
      @break
    @default
      @break
  @endswitch
  {{-- submit --}}
  <div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
      <button type="submit" class="btn btn-primary">
        Update
      </button>
    </div>
  </div>
</form>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
@endsection

@section('scripts')
{{-- Editor --}}
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
</script>

<script>
  ChoicesNum();
  function ChoicesNum()
{
  // check if the number of choice is right
  if ($('#input-choice_num').val()<2||$('#input-choice_num').val()>10)
  {
    alert('Choice number must between 2 and 10!');
    return;
  }
  // set all to d-none
  for (let i=0;i<10;i++)
  {
    $(`#choice-${i}`).attr('class','d-none');
    $(`#choice-${i}`).find('.form-control').attr('disabled',1);
  }
  // make given visible
  var num=$('#input-choice_num').val();
  for (let i=0;i<num;i++)
  {
    $(`#choice-${i}`).removeAttr('class');
    $(`#choice-${i}`).find('.form-control').removeAttr('disabled');
  }
}
</script>
@endsection
