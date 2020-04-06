{{-- Create a choice module in the current post --}}
{{-- Included by "posts.show" --}}

<div class="d-none table-responsive" id="form-create-choice">
  <form class="form" method="POST" action="{{route('modules.store')}}">
    @csrf
    {{-- Post id --}}
		<input type="hidden" name="post_id" value="{{$post->id}}">
		{{-- type --}}
		<input type="hidden" name="type" id="type" value="choice">
    {{-- content --}}
    <table class="table">
      <thead>
        <tr>
          <th>
            <h3>Create a choice question</h3>
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
              <input type="text" id="question_choice" name="question" placeholder="Fill in your question here" required>
            </div>
          </td>
        </tr>
        {{-- optional --}}
        <tr>
          <td>
            <div class="form-group">
              <input type="hidden" name="optional" id="optional" value="0">
              <label class="checkbox">
                <input type="checkbox" name="optional" value="1">
                Is this question optional?
              </label>
            </div>
          </td>
        </tr>
        {{-- type --}}
        <tr>
          <td>
            <div class="form-group">
              <label for="type">
                select the type
                <select class="form-control" name="is_multiple" id="is_multiple">
                  <option value="0">Single choice</option>
                  <option value="1">Multiple choice</option>
                </select>
              </label>
            </div>
          </td>
          <td>
            <div class="form-group">
              <label for="input-choice_num">Number of choices</label>
              <input type="number" id="input-choice_num" class="form-control" min="2" max="10" value="4"
                onchange="ChoicesNum()">
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
              <input type="text" class="form-control" name="choices[]" placeholder="choice {{$i+1}}" disabled required>
            </div>
          </td>
          </tr>
          @endfor
      </tbody>
    </table>
    {{-- submit --}}
    <div class="form-group row mb-0">
      <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
          Create
        </button>
      </div>
    </div>
  </form>
</div>

@section('scripts')
@parent
<script>
  ChoicesNum();
  function ChoicesNum()
{
  // check if the number of choice is right
  if ($('#input-choice_num').val()<2||$('#input-choice_num').val()>10)
  {
    alert('Choice number must between 2 and 10!');
    return;
  }
  // set all to d-none
  for (let i=0;i<10;i++)
  {
    $(`#choice-${i}`).attr('class','d-none');
    $(`#choice-${i}`).find('.form-control').attr('disabled',1);
  }
  // make given visible
  var num=$('#input-choice_num').val();
  for (let i=0;i<num;i++)
  {
    $(`#choice-${i}`).removeAttr('class');
    $(`#choice-${i}`).find('.form-control').removeAttr('disabled');
  }
}
</script>
@endsection
