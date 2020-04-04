{{-- This file shows the module of choice type --}}
{{-- Included by 'modules._show' --}}

<span>{{$module->optional? '(optional)':''}}<b>{{$module->getContent()->question}}</b></span>
<br>

{{-- make the answer exist --}}
<input type="hidden" name="answers[{{$module->id}}]">
{{-- determine if the choice is multiple --}}
@switch($module->getContent()->subtype)
    @case('multiple')
      @foreach ($module->getContent()->options as $option)
      <div class="form-group">
        <label class="checkbox">
         <input type="checkbox" id="module-{{$module->id}}-{{$loop->iteration}}" name="answers[{{$module->id}}][]"
           value="{{$loop->iteration}}">
         {{$option}}
       </label>
      </div>
      @endforeach
      @break
    @case('single')
      @foreach ($module->getContent()->options as $option)
      <div class="form-group" id="module-{{$module->id}}">
        <label class="radio-inline">
          <input type="radio" name="answers[{{$module->id}}]" value="{{$loop->iteration}}">
          {{$option}}
        </label>
      </div>
      @endforeach
      @break
    @case('select')
    <div class="form-group" id="module-{{$module->id}}">
        <select class="form-control" name="answers[{{$module->id}}]">
          @foreach ($module->getContent()->options as $option)
          <option value="{{$option}}">{{$option}}</option>
          @endforeach
        </select>
      </label>
    </div>
    @break
    @case('datalist')
    <div class="form-group" id="module-{{$module->id}}">
      <input class="form-control" name="answers[{{$module->id}}]" type="text" list="data-{{$module->id}}">
      <datalist id="data-{{$module->id}}">
        @foreach ($module->getContent()->options as $option)
        <option value="{{$option}}">{{$option}}</option>
        @endforeach
      </datalist>
    </div>
    @break
    @default
      <p class="red bold">TypeError!</p>
@endswitch
