{{-- This file shows the module of filling type --}}
{{-- Included by 'modules._show' --}}

<span><b>{{$module->getContent()->question}}</b></span>
<br>
@if ($module->getContent()->short)
<input type="text" id="module-{{$module->id}}" name="module-{{$module->id}}">
@else
<textarea id="module-{{$module->id}}" name="module-{{$module->id}}"
  placeholder="Please answer this question"></textarea>
@endif
<br>
