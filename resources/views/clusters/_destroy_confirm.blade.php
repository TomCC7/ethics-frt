{{-- Confirm the delete of the cluster --}}
{{-- included by clusters.list --}}
<div class="modal fade" id="delete-cluster">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Are you absolutely sure?</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        {{-- alert --}}
        <p class="alert alert-warning">
          Unexpected bad things will happen if you don’t read this!
        </p>
        <p>
          This action <strong>cannot</strong> be undone. This will permanently delete the cluster, it's posts and
          questions and also answers that have been collected.
        </p>
        <p>
          If you are sure to do this, please tpye in <strong>{{$content->name}}</strong> to confirm.
        </p>
        {{-- delete form --}}
        <form action="{{route('contents.destroy',$content->slug)}}" method="POST">
          @csrf
          @method('DELETE')
          <div class="form-group">
            <input type="text" class="form-control" name="confirmation" required pattern="{{$content->name}}">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-outline-danger btn-block">
              I understand the consequences, delete this cluster
            </button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
