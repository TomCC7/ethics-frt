{{-- show each record --}}
{{-- included by answers.show_records --}}
<tr>
  <td>{{$record->user->student_id}}</td>
  <td>{{$record->user->first_name}}</td>
  <td>{{$record->user->last_name}}</td>
  <td>
    <a role="button" class="btn btn-outline-info" data-toggle="modal" data-target="#detail-{{$record->id}}">View</a>
  </td>
  <td>{{$record->updated_at}}</td>
  <td>{{$record->batch}}</td>
  <td>
    <form action="{{route('answerrecords.destroy',$record->id)}}" method="POST" id="delete-form-{{$record->id}}"
      onsubmit="return confirm('Do you want to delete this answer?');">
      @csrf
      @method('DELETE')
      @can('superadmin')
      <a href="" onclick="submitDeleteForm({{$record->id}})">
        <i class="far fa-trash-alt"></i>
      </a>
      @else
      <a title="need more priority to do this">
        <i class="far fa-trash-alt gray"></i>
      </a>
      @endcan
    </form>
  </td>
</tr>
