{{-- Edit a choice module --}}
{{-- Included by modules._edit._edit --}}

{{-- content --}}
<h3>Edit a choice question</h3>
{{-- question --}}
<div class="form-group">
  <label for="question">
    Your question
  </label>
  <input type="text" class="form-control" id="question_choice" name="question" placeholder="Fill in your question here"
    required value="{{old('question',$module->getContent()->question)}}">
</div>
{{-- subtype --}}
<div class="form-group">
  <label for="subtype">
    Subtype
  </label>
  <select class="form-control" name="subtype" id="subtype">
    @foreach (app(\App\Content\Module::class)->subtypes('choice') as $subtype)
    <option value="{{$subtype}}" {{is_selected($module->getContent()->subtype,$subtype)}}>
      {{$subtype}}
    </option>
    @endforeach
  </select>
</div>
{{-- choices --}}
<div class="form-group">
  <label for="options">
    Options
  </label>
  <textarea class="form-control" name="options" id="options" rows="5"
    placeholder="{{"e.g.\r\noption1\r\noption2\r\n..."}}">{{old('options',implode("\r\n",$module->getContent()->options))}}</textarea>
</div>
