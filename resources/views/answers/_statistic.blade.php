<table class="table table-striped">
  <thead>
    <tr>
      <td>Contents</td>
      <td>Counts</td>
    </tr>
  </thead>
  <tbody>
@switch($module->type)
  @case('choice')
    @foreach ($module->getContent()->options as $option)
    <tr>
      <td>
        {{$option}}
      </td>
    </tr>
    @endforeach
    @break
  @default
    <tr><td>None</td></tr>
@endswitch
  </tbody>
</table>
