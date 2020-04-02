@extends('layouts.app')
@section('title', 'Answers')

@section('content')
<div>
@each('answers._cluster', $clusters, 'cluster')
</div>
@endsection
