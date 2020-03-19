{{-- This file shows a module --}}
{{-- Included by 'posts.show' --}}
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
