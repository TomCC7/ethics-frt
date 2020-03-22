{{-- Create a text module in the current post --}}
{{-- Included by "posts.show" --}}

<div class="card">

  <form method="POST" action={{route('modules.store')}}>
    @csrf
    {{-- Post id and type --}}
    <input type="hidden" name="post_id" value="{{$post->id}}">
    <input type="hidden" name="type" value="text">

    {{-- content --}}
    <h3>Create a text</h3>
    <div class="form-group">
      <textarea name="body" class="form-control" id="editor" rows="6" placeholder="Please fill in the content"
        required></textarea>
    </div>
    {{-- submit button --}}
    <div class="form-group row mb-0">
      <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
          Create
        </button>
      </div>
    </div>

  </form>
</div>

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
