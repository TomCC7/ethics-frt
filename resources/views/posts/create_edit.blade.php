@extends('layouts.app')

{{-- If id is set, then the post has been created --}}
@section('title',$post->id ? "EditPost" : "CreatePost")

@section('pageHeader')
@if($post->id)
Edit Post
@else
Create Post
@endif
@endsection
@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">

      {{-- determine which form to use --}}
      @if ($post->id)
      <form method="POST" action={{route('posts.update',$post->id)}}>
        @method('PATCH')
        @else
        <form method="POST" action={{route('posts.store')}}>
          @endif

          @csrf

          <div class="form-group">
            <label for='title' class="col-md-4 col-form-label text-md-right">
              Title
            </label>
            <input name='title' id='title' type='text' value="{{ old('title', $post->title ) }}"
              placeholder='Please fill in the title'>
          </div>

          <div class="form-group">
            <label for="cluster_id" class="col-md-4 col-form-label text-md-right">
              Cluster
            </label>
            <select name="cluster_id" id="cluster_id" class="form-control">
              <option value="" hidden disabled selected>Please choose a cluster</option>
              @foreach ($clusters as $cluster)
              <option value='{{$cluster->id}}' {{is_selected($post->cluster_id,$cluster->id)}}>
                {{$cluster->name}}
              </option>
              @endforeach
            </select>
          </div>

          {{-- submit button --}}
          <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                {{$post->id ? 'Update' : 'Create'}}
              </button>
            </div>
          </div>

        </form>
    </div>
  </div>
</div>
@endsection
