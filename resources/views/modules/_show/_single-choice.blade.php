{{-- This file shows the module of single-choice type --}}
{{-- Included by 'modules._show' --}}

{{-- choices in the loop--}}
@php
$order=['A','B','C','D','E','F','G','H','I','J'];
@endphp

<span><b>{{$module->getContent()->question}}</b></span>
<br>
{{-- type --}}
<input type="hidden" id="type-{{$module->id}}" name="types[{{$module->id}}]" value="{{$module->type}}">

@foreach ($module->getContent()->choices as $choice)
<div>
  <input type="radio" id="module-{{$module->id}}" name="answers[{{$module->id}}]" value="{{$loop->iteration}}">
  {{$choice}}
</div>
@endforeach
<br>
