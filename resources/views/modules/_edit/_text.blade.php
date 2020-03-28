{{-- Edit a text module --}}
{{-- Included by modules._edit._edit --}}

{{-- content --}}
<h3>Edit a text</h3>
<div class="form-group">
  {{-- type field --}}
  <input type="hidden" name="type" value="{{$module->type}}">

  <textarea name="body" class="form-control" id="editor" rows="6" placeholder="Please fill in the content"
    required>{{ old('body', $module->getContent()->body) }}</textarea>
</div>
