@extends('layouts.admin')

@section('title') Add company  @endsection

@section('content')
<div class="col-md-9">
  <h2>Companies</h2>
</div>
<div class="col-md-3">

</div>

<div class="col-md-5">
  <div class="panel">
    <h2>Add a company</h2>
    <!-- add company form -->
    {{ Form::open(['route' => 'admin.companies.add']) }}
      {{ Form::text('name', null, ['placeholder' => "Company name*"] ) }}
      {{ Form::submit('Save', ['class' => 'btn red-btn']) }}
    {{ Form::close() }}
    <!-- end of add company form -->
  </div>
</div>

@endsection
