@extends('layouts.admin')

@section('title') Order info  @endsection

@section('content')
  <div class="col-md-9">
    <h2>Orders</h2>
  </div>
  <div class="col-md-3">

  </div>

  <div class="col-md-5">
    <div class="panel">
      <!-- order info -->
      <h2>Order info</h2>
      <ul>
        <li>Order: {{ $order['id'] }}</li>
        <li>User: {{ $order['o_address']['name'] }}</li>
        <li>Total: £{{ $order['o_total'] }}</li>
      </ul>
      <h2>Delivery</h2>
      <ul>
        <li>Type: {{ $order['o_delivery']['dt_name'] }}</li>
      </ul>
      <h2>Products:</h2>
      <ul>

        <!-- listing order products -->
        @foreach($order['o_products'] as $product)
          <li>
            {{$order['o_products_quantities'][$product['p_id']] }} * {{ $product['p_name'] }} -
            @if($product['p_discount_active'] == 1)
              <strike>£{{$product['p_price']}}</strike> £{{$product['p_discount_price']}}
            @else
              £{{$product['p_price']}}
            @endif
          </li>
        @endforeach
        <!-- end of listing order products -->

      </ul>
    </div>
  </div>

@endsection
