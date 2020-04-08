<div class="modal" id="modal-{{$loop->index}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Detail</h3>
        <button data-dismiss="modal">X</button>
      </div>
      <div class="modal-body">
        {{-- single or mult --}}
        @if($module->type==='choice'
        && ($module->getContent()->subtype==='single' || $module->getContent()->subtype==='multiple'))
        <table class="table table-striped">
          <thead>
            <tr>
              <th>
                User
              </th>
              @foreach ($module->getContent()->options as $option)
              <th>{{$loop->iteration}}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach ($module->answers as $answer)
            <tr>
              <td>
                {{$answer->answerRecord->user->student_id}}
              </td>
              {{-- check if the answer is array --}}
              @if(is_array($answer->getContent()))
              @foreach ($module->getContent()->options as $option)
              <th>{!!in_array($option,$answer->getContent())? '&diams;':''!!}</th>
              @endforeach
              @else
              {{-- if not, convert it to array --}}
              @foreach ($module->getContent()->options as $option)
              <th>{!!in_array($option,array($answer->getContent()))? '&diams;':''!!}</th>
              @endforeach
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>

        @else
        {{-- not single or mult --}}
        <table class="table table-striped">
          <thead>
            <tr>
              <th>
                User
              </th>
              <th>
                Answer
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($module->answers as $answer)
            <tr>
              <td>
                {{$answer->answerRecord->user->student_id}}
              </td>
              <td>
                {{$answer->getContent()}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endif
      </div>
    </div>
  </div>
</div>
