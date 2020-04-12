@extends('layouts.app')
@section('title')
Result-{{$post->title}}
@endsection

@section('pageHeader')
<div class="float-left">
  Result of <b><i>{{$post->title}}</i></b>
</div>
<div class="float-right">
  <a href="{{route('answers.show.records',[$post->cluster->slug,$post->slug])}}" class="btn btn-info">Answer Records</a>
</div>
@endsection

@section('content')
<div name='content'>
  @foreach ($modules as $module)
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col"><strong>{{$module->getContent()->question}}</strong></div>
        <div class="col-2">{{$module->type}}-{{$module->getContent()->subtype}}</div>
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
