{{-- Create a new module --}}
{{-- Included by posts.show --}}
@section('modals')
<div class="modal" id="modal-form-select">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="form-group">
          <label for="select-form-select">Type of the module</label>
          <select id="select-form-select" class="form-control" onchange="SelectForm()">
            <option value="" hidden disabled selected>Choose a type</option>
            @foreach (\App\Content\Module::getType() as $type)
            <option value="{{$type}}">{{$type}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="modal-body">
        @include('modules._create._text')
        @include('modules._create._choice')
        @include('modules._create._filling')
      </div>
    </div>
  </div>
</div>
@endsection
