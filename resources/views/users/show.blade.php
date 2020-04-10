@extends('layouts.app')

@section('title','User Detail')

@section('pageHeader')
User Detail
@endsection

@section('content')
{{-- detail --}}
<br>
<table class="table table-hover">
  <tbody class="text-center">
    <tr>
      <td><b>Name</b></td>
      <td>{{$user->name}}</td>
    </tr>
    <tr>
      <td><b>Email</b></td>
      <td>{{$user->email}}</td>
    </tr>
    <tr>
      <td><b>First Name</b></td>
      <td>{{$user->first_name}}</td>
    </tr>
    <tr>
      <td><b>Last Name</b></td>
      <td>{{$user->last_name}}</td>
    </tr>
    @if($basic_info)
    <tr>
      <td><b>User Type</b></td>
      <td>{{$basic_info[0]->getContent()}}</td>
    </tr>
    <tr>
      <td><b>Age</b></td>
      <td>{{$basic_info[1]->getContent()}}</td>
    </tr>
    <tr>
      <td><b>Gender</b></td>
      <td>{{$basic_info[2]->getContent()}}</td>
    </tr>
    <tr>
      <td><b>Nationality</b></td>
      <td>{{$basic_info[3]->getContent()}}</td>
    </tr>
    <tr>
      <td><b>Identification</b></td>
      <td>{{$basic_info[4]->getContent()}}</td>
    </tr>
    @endif
  </tbody>
</table>

{{-- Engilish level Information --}}
@if($language_info)
<caption>
  <h1 class="text-center">Language Information</h1>
</caption>
<table class="table table-hover">
  <tbody class="text-center">
    <tr>
      <td><b>Language</b></td>
      <td>English</td>
      <td><b>Ratings of languages</b></td>
      <td>{{$language_info[0]->getContent()}}</td>
    </tr>
    <tr>
      <td><b>Proficiency in Speaking</b></td>
      <td>{{$language_info[2]->getContent()}}</td>
      <td><b>Proficiency in Listening</b></td>
      <td>{{$language_info[1]->getContent()}}</td>
    </tr>
    <tr>
      <td><b>Proficiency in Writing</b></td>
      <td>{{$language_info[4]->getContent()}}</td>
      <td><b>Proficiency in Reading</b></td>
      <td>{{$language_info[3]->getContent()}}</td>
    </tr>
  </tbody>
</table>
@endif
{{-- Education --}}
@if($education_info)
<caption>
  <h1 class="text-center">Educational Background</h1>
</caption>
<table class="table table-hover">
  <tbody class="text-center">
    <tr>
      <td><b>Highest Educational Degree Achieved</b></td>
      <td>{{$education_info[0]->getContent()}}</td>
    </tr>
    <tr>
      <td><b>Current Pursuing Degree</b></td>
      <td>{{$education_info[1]->getContent()}}</td>
    </tr>
    <tr>
      <td><b>Major</b></td>
      <td>{{$education_info[2]->getContent()}}</td>
    </tr>
    <tr>
      <td><b>Field</b></td>
      <td>{{$education_info[3]->getContent()}}</td>
    </tr>
    <tr>
      <td><b>Highest parental education level</b></td>
      <td>{{$education_info[4]->getContent()}}</td>
    </tr>
    <tr>
      <td><b>Major of Parents</b></td>
      <td>{{$education_info[5]->getContent()}}</td>
    </tr>
    <tr>
      <td><b>Income per Month(RMB)</b></td>
      <td>{{$education_info[6]->getContent()}}</td>
    </tr>
  </tbody>
</table>
@endif
{{-- Belief --}}
@if($belief_info)
<caption>
  <h1 class="text-center">Religious Background</h1>
</caption>
<table class="table table-hover">
  <tbody class="text-center">
    <tr>
      <td><b>Affiliation</b></td>
      <td>{{$belief_info[0]->getContent()}}</td>
    </tr>
    <tr>
      <td><b>Political Orientation</b></td>
      <td>{{$belief_info[1]->getContent()}}</td>
    </tr>
  </tbody>
</table>
@endif
@endsection
