{{-- Create or Edit a module --}}
{{-- Included by posts.create_edit --}}

@if (!$post->id){{-- if no id, it's creating --}}
<label for="editor" class="col-md-4 col-form-label text-md-right">
  Create a content:
</label>
<div class="form-group">
  <textarea name="body" class="form-control" id="editor" rows="6" placeholder="Please fill in the content"
    required></textarea>
</div>

@else

@foreach ($post->modules as $module)

<label for="editor" class="col-md-4 col-form-label text-md-right">
  Content {{$loop->iteration}}:{{--count the loop from 1--}}
</label>
<div class="form-group">
  <textarea name="body-{{$loop->index}}" class="form-control" id="editor" rows="6"
    placeholder="Please fill in the content" required>{{ old('body', $module->getContent())}}</textarea>
</div>

@endforeach
@endif

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('js/module.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/hotkeys.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/uploader.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/simditor.js') }}"></script>

<script>
  $(document).ready(function() {
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
@stop
