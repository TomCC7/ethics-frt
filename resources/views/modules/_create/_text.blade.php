{{-- Create a text module in the current post --}}
{{-- Included by "posts.show" --}}

<div id="form-create-text" class="d-none">

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
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
          Create
        </button>
    </div>

  </form>
</div>
