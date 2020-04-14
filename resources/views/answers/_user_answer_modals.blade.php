{{-- load each answer modals of the user --}}
{{-- Included by answers.show_records.blade.php --}}
@foreach ($records as $record)
{{-- get the answers of the user --}}
@php
$answers=[];
foreach ($record->answers as $answer) {
$answers[$answer->module_id]=$answer->getContent();
}
@endphp
<div class="modal fade" id="detail-{{$record->id}}">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="float-left">Answer of {{$record->user->first_name}}</h3>
        {{-- dismiss button --}}
        <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- include modules --}}
        @foreach ($modules as $module)
        <div class="card">
          <div class="card-body">
            @include('modules._show._show_content')
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endforeach
