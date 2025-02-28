{{-- Create a new module --}}
{{-- Included by posts.show --}}
<div class="modal fade" id="modal-form-select">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="form-group float-left">
          <label for="select-form-select">Type of the module</label>
          <select id="select-form-select" class="form-control" onchange="SelectForm()">
            <option value="" hidden disabled selected>Choose a type</option>
            @foreach (\App\Content\Module::getType() as $type)
            <option value="{{$type}}">{{$type}}</option>
            @endforeach
          </select>
        </div>
        {{-- dismiss button --}}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('modules._create._text')
        @include('modules._create._choice')
        @include('modules._create._filling')
      </div>
    </div>
  </div>
</div>
