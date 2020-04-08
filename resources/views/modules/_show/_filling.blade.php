{{-- This file shows the module of filling type --}}
{{-- Included by 'modules._show' --}}

<span>{{$module->optional? '(optional)':''}}<b>{{$module->getContent()->question}}</b></span>
<br>

<div class="col-md-6 form-group">
  @if ($module->getContent()->subtype==='short')
  <input type="text" class="form-control" id="module-{{$module->id}}" name="answers[{{$module->id}}]"
    placeholder="Answer here" value="{{$answers[$module->id]?? ''}}">
  @else
  <textarea id="module-{{$module->id}}" name="answers[{{$module->id}}]" class="form-control" rows="6"
    placeholder="Please answer this question">{{$answers[$module->id]?? ''}}</textarea>
  @endif
</div>
