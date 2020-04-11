@if ($module->type==='choice')
<div class="card-body">
  <table class="table table-hover">
    <thead>
      <tr>
        <td>Options</td>
        <td>Counts</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($module->getContent()->options as $option)
      <tr>
        <td>
          {{$option}}
        </td>
        <td>
          @if($module->getContent()->subtype!=='multiple')
          {{count($module->answers()->where('content',json_encode($option))->get())}}
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endif
