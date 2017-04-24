@extends('layouts.admin')

@section('title') Add category  @endsection

@section('content')
<div class="col-md-9">
  <h2>Categories</h2>
</div>
<div class="col-md-3">

</div>

<div class="col-md-5">
  <div class="panel">
    <!-- Add category form -->
    <h2>Add category</h2>
    {{ Form::open(['route' => 'admin.categories.add']) }}
      {{ Form::text('pc_name', null, ['placeholder' => "Category name*"] ) }}
      {{ Form::submit('Save', ['class' => 'btn red-btn']) }}
    {{ Form::close() }}
    <!-- end of Add category form -->
  </div>
</div>

@endsection
