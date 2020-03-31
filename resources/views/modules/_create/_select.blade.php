{{-- Create a filling module in the current post --}}
{{-- Included by "posts.show" --}}

<div class="card d-none" id="form-create-select">
  <form method="POST" action="{{route('modules.store')}}">
    @csrf
    {{-- Post id and type --}}
    <input type="hidden" name="post_id" value="{{$post->id}}">
    <input type="hidden" name="type" value="select">
    {{-- question --}}
    <div class="form-group">
      <label for="question">
        Your question
      </label>
      <input type="text" class="form-control" id="question_filling" name="question"
        placeholder="Fill in your question here" required>
    </div>

    <div class="form-group">
      <label>
        option
      </label>
      <input type="text" class="form-control" name="options[]">
    </div>
  </form>
</div>
