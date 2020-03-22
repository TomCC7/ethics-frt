@extends('layouts.app')
@section('title')
Result-{{$post->title}}
@endsection

@section('pageHeader')
Result of <b><i>{{$post->title}}</i></b>
@endsection

@section('content')
<div name='content'>
  <table>
    <thead>
      <tr>
        <th>Question</th>
        <th>Type</th>
        <th>Count</th>
        <th></th>
      </tr>
    <tbody>
      @foreach ($modules as $module)
      <tr>
        <td>{{$module->getContent()->question}}</td>
        <td>{{$module->type}}</td>
        <td>{{count($module->answers)}}</td>
        <td>
          <a class="dropdown-toggle col-sm-3 col-md-3 mr-0" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>
            Detail <span class="caret"></span>
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <h3>Detail</h3>
            <table>
              <thead>
                <tr>
                  <th>
                    User
                  </th>
                  <th>
                    Answer
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($module->answers()->with('user')->get() as $answer)
                <tr>
                  <td>
                    {{$answer->user->student_id}}
                  </td>
                  <td>
                    {{$answer->content}}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </td>
      </tr>

      {{-- The detail information of the answer --}}
      @if (count($module->answers))
      <tr>


        @endif
        @endforeach
    </tbody>
  </table>
</div>
@endsection
