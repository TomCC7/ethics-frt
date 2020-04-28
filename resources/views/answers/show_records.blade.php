@extends('layouts.app')

@section('title')
AnswerRecords-{{$post->title}}
@endsection

@section('pageHeader')
  Answer records for <strong>{{$post->title}}</strong>
@endsection

@section('content')
<div class="card col-8">
  <div class="card-header">
    <div class="float-left">
      {{-- back button --}}
      <a href="{{ route('answers.show_by_post',[$post->cluster->slug,$post->slug]) }}" class="btn btn-info d-inline-block"
        role="button">
        Back
      </a>
    </div>
    <div class="float-right">
      {{-- clear all answers button --}}
      <button class="btn btn-outline-danger" type="button" data-toggle="modal" data-target="#delete-records"
        @cannot('superadmin')disabled title="Need more privelege to do this" @endcannot>
        Clear all answers
      </button>
      {{-- download csv form --}}
      <form action="{{route('answers.download')}}" method="POST" class="d-inline-block">
        @csrf
        <input type="hidden" name="type" value="post">
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <button class="btn btn-success" type="submit">Download CSV</button>
      </form>
    </div>
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
  <div class="card-footer">
    {{ $records->links() }}
  </div>
</div>
@endsection

@section('modals')
@can('superadmin')
@include('answers._destroy_all_confirm')
@endcan
@include('answers._user_answer_modals')

@endsection

@section('scripts')
<script>
  // make the answers disabled
let inputs=$('.answer-disabled');
inputs.attr('disabled','true');
  function submitDeleteForm(id)
{
  event.preventDefault();
  document.getElementById(`delete-form-${id}`).submit();
}
</script>
@endsection
