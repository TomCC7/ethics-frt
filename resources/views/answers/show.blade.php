@extends('layouts.app')
@section('title')
Result-{{$post->title}}
@endsection

@section('pageHeader')
Result of <b><i>{{$post->title}}</i></b>
@endsection

@section('content')
<div name='content'>
  @foreach ($modules as $module)
  <div class="card">
    <div class="card-header">
      <div class="row">
      <div class="col">{{$module->getContent()->question}}</div>
      <div class="col-2">{{$module->type}}</div>
      <div class="col-2">{{count($module->answers)}}</div>
      <div class="col-2">
        <button data-toggle="modal" data-target="#modal-{{$loop->index}}" class="btn btn-info">Detail</button>
        @include('answers._detail')
      </div>
      </div>
    </div>
      @include('answers._statistic')
  </div>
  @endforeach
</div>
@endsection
