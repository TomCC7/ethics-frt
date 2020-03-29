{{-- This file shows the module of multiple-choice type --}}
{{-- Included by 'modules._show' --}}

<span>{{$module->optional? '(optional)':''}}<b>{{$module->getContent()->question}}</b></span>
<br>

<input type="hidden" name="answers[{{$module->id}}]">
@foreach ($module->getContent()->choices as $choice)
<div>
  <input type="checkbox" id="module-{{$module->id}}-{{$loop->iteration}}" name="answers[{{$module->id}}][]"
    value="{{$loop->iteration}}">
  {{$choice}}
</div>
@endforeach
