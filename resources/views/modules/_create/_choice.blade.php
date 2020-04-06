{{-- Create a choice module in the current post --}}
{{-- Included by "posts.show" --}}

<div class="card d-none" id="form-create-choice">
  <form method="POST" action="{{route('modules.store')}}">
    @csrf
    {{-- Post id and type --}}
    <input type="hidden" name="post_id" value="{{$post->id}}">
    <input type="hidden" name="type" value="choice">
    {{-- question --}}
    <div class="form-group">
      <label for="question">
        Your question
      </label>
      <input type="text" class="form-control" id="question_choice" name="question"
        placeholder="Fill in your question here" required>
    </div>
    {{-- subtype --}}
    <div class="form-group">
      <label for="subtype">
        Subtype
      </label>
      <select class="form-control" name="subtype" id="subtype">
        @foreach (app(\App\Content\Module::class)->subtypes('choice') as $subtype)
        <option value="{{$subtype}}">{{$subtype}}</option>
        @endforeach
      </select>
    </div>
    {{-- optional --}}
    <div class="form-group">
      <input type="hidden" name="optional" value="0">
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
  </form>
</div>
