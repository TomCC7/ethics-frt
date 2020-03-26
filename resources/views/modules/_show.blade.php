{{-- This file shows a module --}}
{{-- Included by 'posts.show' --}}
{{-- <a href="{{route('modules.edit',$module->id)}}"><button class="btn btn-success">Edit</button></a> --}}
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
