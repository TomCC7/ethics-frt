{{-- Confirm the delete of all answers in the post --}}
{{-- included by answers.show_records --}}
<div class="modal fade" id="delete-records">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Are you absolutely sure?</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <p>
          This action <strong>cannot</strong> be undone. This will permanently delete all the answers. Make sure that
          you have saved all data you wanted.
        </p>
        <p>
          If you are sure to do this, please tpye in <strong>I understand</strong> to confirm.
        </p>
        {{-- delete form --}}
        <form action="{{route('answerrecords.destroyall',$post->slug)}}" method="POST">
          @csrf
          @method('DELETE')
          <div class="form-group">
            <input tpye="text" class="form-control" required pattern="I understand" name="confirmation">
          </div>
          <button class="btn btn-outline-danger btn-block" type="submit">
            Clear all answers
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
