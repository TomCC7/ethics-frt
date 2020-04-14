{{-- This file shows a module --}}
{{-- Included by 'posts.show' --}}
<div class="card">
  {{-- Header that can only be seen by admin --}}
  @include('modules._show._show_admin_header')

  {{-- body --}}
  <div class="card-body">
    @include('modules._show._show_content')
  </div>
</div>
