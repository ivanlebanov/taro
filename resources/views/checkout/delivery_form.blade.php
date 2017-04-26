<div class="col-sm-6">
  <div class="panel">
    <h2>Delivery methods</h2>
    <!-- delivery form -->
    {{ Form::open(['route' => 'delivery.add']) }}

      @foreach($delivery_types as $key => $delivery_type)
        @if($delivery_type['id'] == $delivery_type_id)
          {{ Form::radio('delivery_type', $delivery_type['attributes']['id'], true,
          array('id'=>'delivery-' . $key, 'class' => 'hidden')) }}
          {{ Form::label('delivery-' . $key,
          $delivery_type['attributes']['dt_name']
          . " (" . $delivery_type['attributes']['dt_length'] . ", +£" . $delivery_type['attributes']['dt_price'] . ")") }}
        @else
          {{ Form::radio('delivery_type', $delivery_type['attributes']['id'], false,
          array('id'=>'delivery-' . $key, 'class' => 'hidden')) }}
          {{ Form::label('delivery-' . $key,
          $delivery_type['attributes']['dt_name']
          . " (" . $delivery_type['attributes']['dt_length'] . ", +£" . $delivery_type['attributes']['dt_price'] . ")") }}
        @endif
      @endforeach

      {{ Form::submit('Save', ['class' => 'btn red-btn']) }}

    {{ Form::close()}}
    <!-- end of delivery form -->

  </div>
</div>
