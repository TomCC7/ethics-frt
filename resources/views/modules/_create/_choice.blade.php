{{-- Create a choice module in the current post --}}
{{-- Included by "posts.show" --}}

<div class="card">
  <form method="POST" action="{{route('modules.store')}}">
    @csrf
    {{-- Post id --}}
    <input type="hidden" name="post_id" value="{{$post->id}}">

    {{-- content --}}
    <h3>Create a choice question</h3>
    {{-- type --}}
    <div class="form-group">
      <label for="type">
        select the type
      </label>
      <select name="type" id="type">
        <option value="single-choice">Single choice</option>
        <option value="multiple-choice">Multiple choice</option>
      </select>
    </div>
    {{-- question --}}
    <div class="form-group">
      <label for="question">
        Your question
      </label>
      <input type="text" id="question" name="question" placeholder="Fill in your question here">
    </div>
    {{-- choices(js needed) --}}
    @for ($i = 0; $i < 4; $i++) <div class="form-group">
      <label for="choice-{{$i}}">
        Choice {{$i}}
      </label>
      <input type="text" name="choices[]" id="choice-{{$i}}" placeholder="choice {{$i}}">
</div>
@endfor
{{-- submit --}}
<div class="form-group row mb-0">
  <div class="col-md-6 offset-md-4">
    <button type="submit" class="btn btn-primary">
      Create
    </button>
  </div>
</div>
</form>
</div>
