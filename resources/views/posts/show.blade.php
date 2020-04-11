{{-- this file shows the content of a post --}}
@extends('layouts.app')

@section('title',$post->title . '-Post')

@section('pageHeader')
Post: <small>{{$post->title}}</small>
@can('admin')
<span><button class="btn btn-success" data-toggle="modal" data-target="#edit-post">Edit</button></span>
@endcan
@endsection

@section('content')
<div id="content">
  @cannot('admin')
  <form method="POST" action="{{route('answers.store',$post->slug)}}">
    @csrf
    @method('PUT')
    @endcannot

    {{-- include modules --}}
    @foreach ($post->modules as $module)
    @include('modules._show._show')
    @endforeach

    {{-- submit button --}}
    {{-- Can't be seen by admin --}}
    @cannot('admin')
    {{-- Only can be seen when there's question --}}
    @if ($post->modules()->question()->first())

    @if($answer_record)
    <button type="submit" class="btn btn-secondary"
      onclick="return confirm('Are you sure you want to resubmit your answer?');">
      Resubmit answer
    </button>
    <span class="d:inline">You've submitted your answer at
      {{$answer_record->updated_at}}!</span>
    @else
    <button type="submit" class="btn btn-primary">
      Submit answer
    </button>
    @endif
    @endif
  </form>
  @endcannot

  {{-- Creating --}}
  @can('admin')
  <span><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-form-select">
      Create a new module
    </button></span>
  @endcan
</div>
</div>
@endsection

@section('modals')
@include('modules._create._create')
@include('posts._edit')
@endsection

{{-- Render the rich text editor --}}
@include('shared._editor')

@section('scripts')
<script>
  function SelectForm()
  {
    // getting the variables
    var text_form=document.getElementById("form-create-text");
    var choice_form=document.getElementById("form-create-choice");
    var filling_form=document.getElementById("form-create-filling");
    var select=$('#select-form-select');
    // make all forms hidden
    text_form.className="card d-none";
    choice_form.className="d-none table-responsive";
    filling_form.className="card d-none";
    switch (select.val())
    {
      case "text":
        text_form.className="card";
        break;
      case "choice":
        choice_form.className="table-responsive";
        break;
      case "filling":
        filling_form.className="card";
        break;
      default:
        break;
    }
  }
</script>
@endsection
