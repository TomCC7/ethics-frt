@extends('layouts.app')
@section('title')
  Answers by {{$user->first_name.' '.$user->last_name}}
@endsection

@section('pageHeader')
<div class="float-left">
  Answers by <b>{{$user->first_name.' '.$user->last_name}}</b>
</div>
@endsection

@section('content')
<table class="table">
  <thead><tr>
      <td>Post</td>
      <td>Submitted at</td>
  </tr></thead>
  <tbody>
    @foreach ($answer_records as $answer_record)
      <tr>
        <td>#{{ $answer_record->post_id }}
          <a role="button" data-toggle="modal" href="#detail-{{$answer_record->id}}">
            {{ $answer_record->post->title }}</a></td>
        <td>{{ $answer_record->updated_at }}</td>
        </li>
      </tr>
    @endforeach
  </tbody>
</table>
@include('answers._user_answer_modals')
@endsection
