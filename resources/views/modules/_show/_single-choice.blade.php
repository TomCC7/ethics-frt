{{-- This file shows the module of single-choice type --}}
{{-- Included by 'modules._show' --}}

<span>{{$module->optional? '(optional)':''}}<b>{{$module->getContent()->question}}</b></span>
<br>

<input type="hidden" name="answers[{{$module->id}}]">
@foreach ($module->getContent()->choices as $choice)
<div class="form-group" id="module-{{$module->id}}">
  <label class="radio-inline">
    <input type="radio" name="answers[{{$module->id}}]" value="{{$loop->iteration}}">
    {{$choice}}
  </label>
</div>
@endforeach
