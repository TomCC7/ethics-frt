{{-- This file displays one row of a user's information --}}
{{-- The file is included by users.index --}}
<tr>
  {{--  $loop is a variable in the blade template loop recording loop information --}}
  {{-- Can also be delivered to the child template --}}
  <td>{{$user->id}}</td>
  <td>{{$user->name}}</td>
  <td>{{$user->email}}</td>
  <td>{{$user->first_name}}</td>
  <td>{{$user->last_name}}</td>
  <td>{{$user->student_id}}</td>

  <td><a href="{{ route('users.show', $user->id) }}"><button>
  Detail
  </button></a></td>
  <td><a href="{{ route('users.edit', ["user" => $user->id, "self_editing" => false] ) }}"><button> {{-- "false" is $self_editing --}}
  Edit
  </button></a></td>
</tr>
