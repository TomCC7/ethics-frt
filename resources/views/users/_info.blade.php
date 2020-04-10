{{-- This file displays one row of a user's information --}}
{{-- The file is included by users.index --}}
<tr>
  {{--  $loop is a variable in the blade template loop recording loop information --}}
  {{-- Can also be delivered to the child template --}}
  <td>{{$user->id}}</td>
  <td class="role-{{ $user->is_admin }}">{{$user->name}}</td>
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
  @if(Auth::user()->is_admin > 1 and $user->is_admin < 2) {{-- only superadmins can set admins; nobody can set superadmins --}}
    <td>
      <form method="POST" action={{ route('users.setAdmin', $user->id) }}>
      @csrf @method('PATCH')
      @if(!$user->is_admin)
        <input type="hidden" name="is_admin" value="1">
        <button type="submit">Set as admin</button>
      @elseif($user->is_admin == 1)
        <input type="hidden" name="is_admin" value="0">
        <button type="submit">Set as user</button>
      @endif
    </td>
  @endif
</tr>
