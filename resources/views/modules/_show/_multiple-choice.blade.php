{{-- This file shows the module of multiple-choice type --}}
{{-- Included by 'modules._show' --}}

{{-- choices in the loop--}}
@php
$order=['A','B','C','D','E','F','G','H','I','J'];
@endphp

<span><b>{{$module->getContent()->question}}</b></span>
<br>
@foreach ($module->getContent()->choices as $choice)
<div>
  <input type="checkbox" name="module-{{$module->id}}-{{$loop->iteration}}" value="{{$loop->iteration}}">
  {{$choice}}
</div>
@endforeach
<br>
