{{-- type --}}
@if($module->type!=='text')
<input type="hidden" id="type-{{$module->id}}" name="types[{{$module->id}}]" value="{{$module->type}}">
@endif

@switch($module->type)
  @case('text')
    @include('modules._show._text')
    @break
  @case('choice')
    @include('modules._show._choice')
    @break
  @case('filling')
    @include('modules._show._filling')
    @break
  @default
    @break
@endswitch
