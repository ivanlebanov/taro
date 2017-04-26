@extends('layouts.admin')

@section('title') Sliders  @endsection

@section('content')


  <div class="col-md-9">
    <h2>Sliders</h2>
  </div>
  <div class="col-md-3"></div>

  <div class="col-md-5">
    <div class="panel">
      <h2>Add a slider</h2>
      <!-- add slider form -->
      {{ Form::open([ 'route' => ['admin.sliders.add'], 'enctype' => 'multipart/form-data']) }}
        {{ Form::text('title', null, ['placeholder' => "Title*"] ) }}
        {{ Form::text('link', null, ['placeholder' => "Link*"] ) }}
        <div>
          {{ Form::file('image', null) }}
        </div>
        {{ Form::submit('Save', ['class' => 'btn red-btn']) }}
      {{ Form::close() }}
      <!-- end of add slider form -->
    </div>
  </div>

  @endsection
