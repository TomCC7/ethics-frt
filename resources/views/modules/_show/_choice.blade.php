{{-- This file shows the module of choice type --}}
{{-- Included by 'modules._show' --}}

<span>{{$module->optional? '(optional)':''}}<b>{{$module->getContent()->question}}</b></span>
<br>

{{-- make the answer exist --}}
<input type="hidden" name="answers[{{$module->id}}]">
{{-- determine if the choice is multiple --}}
@if($module->getContent()->is_multiple)
@foreach ($module->getContent()->choices as $choice)
<div class="form-group">
  <label class="checkbox">
    <input type="checkbox" id="module-{{$module->id}}-{{$loop->iteration}}" name="answers[{{$module->id}}][]"
      value="{{$loop->iteration}}">
    {{$choice}}
  </label>
</div>
@endforeach
@else
@foreach ($module->getContent()->choices as $choice)
<div class="form-group" id="module-{{$module->id}}">
  <label class="radio-inline">
    <input type="radio" name="answers[{{$module->id}}]" value="{{$loop->iteration}}">
    {{$choice}}
  </label>
</div>
@endforeach
@endif
