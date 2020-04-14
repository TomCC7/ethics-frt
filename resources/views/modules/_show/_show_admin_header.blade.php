{{-- show the header of the module which can only be seen by admin --}}
{{-- Included by modules._show._show --}}
@can('admin')
<div class="card-header">
  <h3>{{$loop->iteration}}: {{$module->type}}
    <span class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
      aria-expanded="false">
    </span>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <span class="dropdown-item">
        <a class="btn btn-success btn-block" href="{{route('modules.edit',$module->id)}}" role="button">
          Edit
        </a>
      </span>

      <div class="dropdown-divider"></div>

      <span class="dropdown-item">
        <form action="{{route('modules.destroy',$module->id)}}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-block"
            onclick="return confirm('All the answers of the module will also be deleted!');">
            Delete
          </button>
        </form>
      </span>

    </div>
  </h3>
</div>
@endcan
