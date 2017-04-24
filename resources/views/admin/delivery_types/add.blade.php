@extends('layouts.admin')

@section('title') Add delivery type  @endsection

@section('content')
<div class="col-md-9">
  <h2>Delivey types</h2>
</div>
<div class="col-md-3">

</div>

<div class="col-md-5">
  <div class="panel">
    <h2>Add delivery type</h2>
    <!-- delivery types form -->
    {{ Form::open([ 'route' => ['admin.delivery-types.add']]) }}
      {{ Form::text('name', null, ['placeholder' => "Name*"] ) }}
      {{ Form::text('price', null, ['placeholder' => "Price*"] ) }}
      {{ Form::text('length', null, ['placeholder' => "Length*"] ) }}
      {{ Form::submit('Save', ['class' => 'btn red-btn']) }}
    {{ Form::close() }}
    <!-- end of delivery types form -->
  </div>
</div>

@endsection
