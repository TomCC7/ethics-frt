@extends('layouts.app')
@section('title')
Result-{{$post->title}}
@endsection

@section('pageHeader')
Result of <b><i>{{$post->title}}</i></b>
@endsection

@section('content')
<div name='content'>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Question</th>
        <th>Type</th>
        <th>Count</th>
        <th></th>
      </tr>
    <tbody>
      @foreach ($modules as $module)
      <tr>
        <td>{{$module->getContent()->question}}</td>
        <td>{{$module->type}}</td>
        <td>{{count($module->answers)}}</td>
        <td>
          <button data-toggle="modal" data-target="#modal-{{$loop->index}}" class="btn btn-info">Detail</button>
          @include('answers._detail')
         </td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>
@endsection
