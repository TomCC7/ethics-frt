{{-- This file shows the module of filling type --}}
{{-- Included by 'modules._show' --}}

<span><b>{{$module->getContent()->question}}</b></span>
<br>
{{-- type --}}
<input type="hidden" id="type-{{$module->id}}" name="types[{{$module->id}}]" value="{{$module->type}}">

@if ($module->getContent()->short)
<input type="text" id="module-{{$module->id}}" name="answers[{{$module->id}}]" placeholder="Answer here">
@else
<textarea id="module-{{$module->id}}" name="answers[{{$module->id}}]"
  placeholder="Please answer this question"></textarea>
@endif
<br>
