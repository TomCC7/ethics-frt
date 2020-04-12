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
    <a href="{{route('answers.show',[$post->cluster->slug,$post->slug])}}" class="btn btn-info" role="button">
      Back
    </a>
    {{-- download csv form --}}
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
  <div class="card-footer">
    {{ $records->links() }}
  </div>
</div>
@endsection

@section('modals')
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
