{{-- Edit a filling module --}}
{{-- Included by modules._edit._edit --}}

{{-- content --}}
<h3>Edit a filling</h3>
<div class="form-group">
  {{-- type field --}}
  <input type="hidden" name="type" value="{{$module->type}}">

  <label for="question">
    Your question
  </label>
  <input type="text" id="question_filling" name="question" placeholder="Fill in your question here" required
    value="{{old('question',$module->getContent()->question)}}">
</div>

<div class="form-group">
  <input type="hidden" name="subtype" id="subtype" value="long">
  <label class="checkbox">
    <input type="checkbox" name="subtype" value="short" {{$module->getContent()->short ? 'checked' : ''}}>
    Is this question a short one?
  </label>
</div>
