<table class="table table-striped">
  <thead>
    <tr>
      <td>Contents</td>
    </tr>
  </thead>
  <tbody>
@switch($module->type)
  @case('choice')
    @foreach ($module->getContent()->choices as $choice)
    <tr>
      <td>
        {{$choice}}
      </td>
    </tr>
    @endforeach
    @break
  @default
    <tr><td>None</td></tr>
@endswitch
  </tbody>
</table>
