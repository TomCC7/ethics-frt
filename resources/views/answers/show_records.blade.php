@extends('layouts.app')

@section('title')
AnswerRecords-{{$post->title}}
@endsection

@section('pageHeader')
AnswerRecords-{{$post->title}}
@endsection

@section('content')
<div class="card col-8">
  <div class="card-header">
    <form action="{{route('answers.download')}}" method="POST" class="float-right">
      @csrf
      <input type="hidden" name="type" value="post">
      <input type="hidden" name="post_id" value="{{$post->id}}">
      <button class="btn btn-success" type="submit">Download CSV</button>
    </form>
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Student id</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Detail</th>
          <th>Submit Time</th>
          <th title="Times users change their answers">Batch</th>
          <th>Options</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($records as $record)
        @include('answers._record_row')
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

@section('scripts')
<script>
  function submitDeleteForm(id)
{
  event.preventDefault();
  document.getElementById(`delete-form-${id}`).submit();
}
</script>
@endsection

@section('modals')
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
        @include('modules._show._show')
        @endforeach
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection
