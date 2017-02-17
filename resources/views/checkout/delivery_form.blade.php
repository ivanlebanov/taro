<div class="col-sm-6">
  <div class="panel">
    <h2>Delivery methods</h2>
    <!-- check if the user has a saved option -->
    @if(true == false)

    @else
      {{ Form::open(['route' => 'delivery.add']) }}
        @foreach($delivery_types as $key => $delivery_type)
          @if($key == 0)
            {{ Form::radio('delivery_type', $delivery_type['attributes']['id'], true,
            array('id'=>'delivery-' . $key, 'class' => 'hidden')) }}
            {{ Form::label('delivery-' . $key, $delivery_type['attributes']['dt_name']) }}
          @else
            {{ Form::radio('delivery_type', $delivery_type['attributes']['id'], false,
            array('id'=>'delivery-' . $key, 'class' => 'hidden')) }}
            {{ Form::label('delivery-' . $key, $delivery_type['attributes']['dt_name']) }}
          @endif
        @endforeach

        {{ Form::submit('Save', ['class' => 'btn red-btn']) }}

      {{ Form::open(['route' => 'profile.update']) }}
    @endif


  </div>


</div>
