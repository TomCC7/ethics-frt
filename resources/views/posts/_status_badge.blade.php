{{-- status badge --}}
{{-- included by posts.show --}}
@switch($post->status)
@case('unreleased')
<span class="badge badge-secondary badge-pill" title="unreleased post,should release for users to view">unreleased</span>
@break
@case('released')
@can('admin')
<span class="badge badge-success badge-pill">released</span>
@endcan
@break
@case('archived')
<span class="badge badge-secondary badge-pill"
  title="Archived, can only see the post without updating answers">archived</span>
@break
@default
<span class="badge badge-danger badge-pill">status error</span>
@break
@endswitch
