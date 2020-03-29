{{-- Create a new module --}}
{{-- Included by posts.show --}}

<div class="modal" id="modal-form-select">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">

        <div class="form-group">
          <label for="select-form-select">Type of the module</label>
          <select id="select-form-select" class="form-control" onchange="SelectForm()">
            <option value="" hidden disabled selected>Choose a type</option>
            <option value="text">Text</option>
            <option value="choice">Choice</option>
            <option value="filling">Filling</option>
          </select>
        </div>

        @include('modules._create._text')
        @include('modules._create._choice')
        @include('modules._create._filling')
      </div>
    </div>
  </div>
