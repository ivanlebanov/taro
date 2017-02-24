@extends('layouts.admin')

@section('title') Add user  @endsection

@section('content')
<div class="col-md-9">
  <h2>Users</h2>
</div>
<div class="col-md-3">

</div>

<div class="col-md-5">
  <div class="panel">
    <h2>Edit user</h2>
    {{ Form::open([ 'route' => ['admin.users.update', 'id' =>  $user['id'] ] , 'method' => 'PUT']) }}
      {{ Form::text('name', $user['name'], ['placeholder' => "Name*"] ) }}
      {{ Form::text('email', $user['email'], ['placeholder' => "E-mail*"] ) }}
      {{ Form::text('telephone', $user['telephone'], ['placeholder' => "Telephone*"] ) }}
      {{ Form::text('address', $user['address'], ['placeholder' => "Address*"] ) }}
      {{ Form::text('town_city', $user['town_city'], ['placeholder' => "City*"] ) }}
      <div class="select-style">
        {{ Form::select('country', get_countries(),  $user['country'], ['placeholder' =>  "Country*"]) }}
      </div>
      {{ Form::text('postcode', $user['postcode'], ['placeholder' => "Postcode*"] ) }}
      {{ Form::text('is_admin', $user['is_admin'], ['placeholder' => "Admin"] ) }}


      @foreach($delivery_types as $key => $delivery_type)
        @if($delivery_type['id'] == $delivery_type_id)
          {{ Form::radio('delivery_type_id', $delivery_type['id'], true,
          array('id'=>'delivery-' . $key, 'class' => 'hidden')) }}
          {{ Form::label('delivery-' . $key,
          $delivery_type['dt_name']
          . " (" . $delivery_type['dt_length'] . ", +£" . $delivery_type['dt_price'] . ")") }}
        @else
          {{ Form::radio('delivery_type_id', $delivery_type['id'], false,
          array('id'=>'delivery-' . $key, 'class' => 'hidden')) }}
          {{ Form::label('delivery-' . $key,
          $delivery_type['dt_name']
          . " (" . $delivery_type['dt_length'] . ", +£" . $delivery_type['dt_price'] . ")") }}
        @endif
      @endforeach


      {{ Form::submit('Save', ['class' => 'btn red-btn']) }}
    {{ Form::close() }}
  </div>
</div>

@endsection
