@extends('layouts.admin')

@section('title') Sliders  @endsection

@section('content')


  <div class="col-md-9">
    <h2>Sliders</h2>
  </div>
  <div class="col-md-3">

  </div>

  <div class="col-md-5">
    <div class="panel">
      <h2>Edit a slider</h2>
      <img src="{{asset($slider['s_image'])}}" alt="current slider image">
      {{ Form::open([ 'route' => ['admin.sliders.update', 'id' => $slider['id']  ],
       'method' => 'PUT' , 'enctype' => 'multipart/form-data']) }}
        {{ Form::text('title', $slider['s_title'], ['placeholder' => "Title*"] ) }}
        {{ Form::text('link', $slider['s_link'], ['placeholder' => "Link*"] ) }}
        <div>
          {{ Form::file('image', null) }}
        </div>
        {{ Form::submit('Save', ['class' => 'btn red-btn']) }}
      {{ Form::close() }}
    </div>
  </div>


  @endsection
