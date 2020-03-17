{{-- This file shows a module --}}
{{-- Included by 'posts.show' --}}
@switch($module->type)
    @case('text')
        @include('modules._show_text')
        @break

    @default
    @break
@endswitch
