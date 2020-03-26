<div class="modal" id="modal-{{$loop->index}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Detail</h3>
        <button data-dismiss="modal">X</button>
      </div>
      <div class="modal-body">
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
            @foreach ($module->answers()->with('user')->get() as $answer)
            <tr>
              <td>
                {{$answer->user->student_id}}
              </td>
              <td>
                {{$answer->content}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
