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
    {{-- optional --}}
    <div class="form-group">
      <input type="hidden" name="optional" id="optional" value="0">
      <label class="checkbox">
        <input type="checkbox" name="optional" value="1">
        Is this question optional?
      </label>
    </div>

    <div class="form-group">
      <label for="options">
        options
      </label>
      <textarea class="form-control" name="options" id="options" rows="5"
        placeholder="{{"e.g.\r\noption1\r\noption2\r\n..."}}">
</textarea>
    </div>

    {{-- submit button --}}
    <div class="form-group row mb-0">
      <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
          Create
        </button>
      </div>
    </div>
    </fo rm>
</div>
