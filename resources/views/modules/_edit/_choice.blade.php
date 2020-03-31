{{-- Edit a choice module --}}
{{-- Included by modules._edit._edit --}}

{{-- content --}}
<table class="table">
  <thead>
    <tr>
      <th>
        <h3>Edit a choice question</h3>
      </th>
    </tr>
  </thead>
  <tbody>
    {{-- question --}}
    <tr>
      <td>
        <div class="form-group">
          <label for="question">
            Your question
          </label>
          <input type="text" class="form-control" id="question_choice" name="question"
            placeholder="Fill in your question here" required
            value="{{old('question',$module->getContent()->question)}}">
        </div>
      </td>
    </tr>
    {{-- type --}}
    <tr>
      <td>
        <div class="form-group">
          <label for="type">
            select the type
            <select class="form-control" name="type" id="type">
              <option value="0" {{$module->getContent()->is_multiple==false ? 'selected' : ''}}>
                Single choice
              </option>
              <option value="1" {{$module->getContent()->is_multiple==true ? 'selected' : ''}}>
                Multiple choice
              </option>
            </select>
          </label>
        </div>
      </td>
      <td>
        <div class="form-group">
          <label for="input-choice_num">Number of choices</label>
          <input type="number" id="input-choice_num" name="choice_num" class="form-control" min="2" max="10"
            value="{{old('choice-num',count($module->getContent()->choices))}}" onchange="ChoicesNum({{$module->id}})">
        </div>
      </td>
    </tr>
    {{-- choices(js needed) --}}
    @for ($i=0; $i < 10; $i++) <tr id="choice-{{$i}}" class="d-none">
      <td>
        <div class="form-group">
          <label for="choice-{{$i}}">
            Choice {{$i+1}}
          </label>
          <input type="text" class="form-control" name="choices[]" placeholder="choice {{$i+1}}" disabled required
            value="{{$module->getContent()->choices[$i] ?? ''}}">
        </div>
      </td>
      </tr>
      @endfor
  </tbody>
</table>
