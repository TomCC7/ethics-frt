@extends('layouts.app')

{{-- If id is set, then the post has been created --}}
@section('title',$post->id ? "EditPost" : "CreatePost")

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">

      <h2 class="">
        @if($post->id)
        Edit Post
        @else
        Create Post
        @endif
      </h2>

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
            <input name='title' type='text' value="{{ old('title', $post->title ) }}">
          </div>

          <div class="form-group">
            <label for="cluster_id" class="col-md-4 col-form-label text-md-right">
              Cluster
            </label>
            <select name="cluster_id" class="form-control">
              @foreach ($clusters as $cluster)
              <option value='{{$cluster->id}}' {{$post->cluster_id == $cluster->id ? 'selected' : ''}}>
                {{$cluster->name}}
              </option>
              @endforeach
            </select>
          </div>

          <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{$post->id ? 'Store' : 'Create'}}
                </button>
            </div>
        </div>

        </form>
    </div>
  </div>
</div>
@endsection
