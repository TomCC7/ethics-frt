@extends('layouts.app')

@section('title', 'Answers')

@section('pageHeader', 'Answers collected')

@section('content')
<div>
@each('answers._cluster', $clusters, 'cluster')
</div>
@endsection
