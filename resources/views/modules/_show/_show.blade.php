{{-- This file shows a module --}}
{{-- Included by 'posts.show' --}}
{{-- <a href="{{route('modules.edit',$module->id)}}"><button class="btn btn-success">Edit</button></a> --}}
<div class="card">
  {{-- Header that can only be seen by admin --}}
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
{{-- body --}}
<div class="card-body">
  @switch($module->type)
  @case('text')
  @include('modules._show._text')
  @break
  @case('single-choice')
  @include('modules._show._single-choice')
  @break
  @case('multiple-choice')
  @include('modules._show._multiple-choice')
  @break
  @case('filling')
  @include('modules._show._filling')
  @break
  @default
  @break
  @endswitch
</div>
</div>
