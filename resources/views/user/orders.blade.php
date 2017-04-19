@extends('layouts.app')

@section('title') Your orders @endsection

@section('content')
  <div class="container">
    @if(count($orders) > 0)
      <h2>Orders</h2>
      @foreach($orders as $key => $order)

        @include('includes.list_products', [ 'products' => $order['o_products'],
        'title' => 'Order #' . $order['id'] .' - £' . $order['o_total'],
        'quantity' => true, 'quantities' => $order['o_products_quantities'], 'order' => $order ] )

      @endforeach

    @else
      <div class="panel">
        <h2>Orders</h2>
        <p>No completed orders.</p>
      </div>
    @endif
  </div>
@endsection
