<div class="modal" id="edit-post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Edit Post Information</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('posts.update',$post->id)}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="modal-body">
          {{-- title --}}
          <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" id="title" name="title" value="{{old('title',$post->title)}}">
          </div>
          {{-- Prerequisite --}}
          <div class="form-group">
            <label for="prerequisite">Prerequisite(user have to complete the prerequisite before they do this
              post,default
              null)</label>
            <input class="form-control" type="number" id="prerequisite" name="prerequisite"
              value="{{old('prerequisite',$post->prerequisite)}}">
          </div>
          {{-- Redirect --}}
          <div class="form-group">
            <label for="redirect">Redirect(The link users will go when they finish the post,default back)</label>
            <input class="form-control" type="text" id="redirect" name="redirect"
              value="{{old('redirect',$post->redirect)}}">
          </div>
          {{-- Message --}}
          <div class="form-group">
            <label for="message">Message(customize the message flashes when the user finishes the post)</label>
            <input class="form-control" type="text" id="message" name="message"
              value="{{old('message',$post->message)}}">
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
