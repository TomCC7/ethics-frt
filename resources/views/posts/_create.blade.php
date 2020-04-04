<div class="modal" id="create-post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Create a Post Here</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('posts.store')}}" method="POST">
        @csrf
        {{-- cluster_id --}}
        <input type="hidden" name="cluster_id" value="{{$cluster->id}}">

        <div class="modal-body">
          {{-- title --}}
          <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" id="title" name="title" value="{{old('title')}}">
          </div>
        </div>
        <div class="modal-footer">
          <div class="form-group">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button class="btn btn-success" type="submit">Update</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
