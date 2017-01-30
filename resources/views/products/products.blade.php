@extends('layouts.app')

@section('content')

  <?php foreach ($products as $key => $value): ?>
    {{$value['category']}} -
    {{$value['p_name']}}
  <?php endforeach; ?>
@endsection
