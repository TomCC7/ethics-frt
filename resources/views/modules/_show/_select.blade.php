{{-- This file shows the module of select type --}}
{{-- Included by 'modules._show' --}}
<span>{{$module->optional? '(optional)':''}}<b>{{$module->getContent()->question}}</b></span>
<br>

{{-- make the answer exist --}}
<input type="hidden" name="answers[{{$module->id}}]">
<div class="form-group">
	<select class="form-control" name="answers[{{$module->id}}]">
		<option value="" disabled hidden selected>Please choose an answer</option>
    @foreach ($module->getContent()->options as $option)
    <option value="{{$loop->iteration}}">{{$option}}</option>
    @endforeach
  </select>
</div>
