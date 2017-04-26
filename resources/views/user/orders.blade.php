@extends('layouts.app')

@section('title') Your orders @endsection

@section('content')
  <div class="container">
    @if(count($orders) > 0)
      <h2>Orders</h2>
      <!-- list of all orders -->
      @foreach($orders as $key => $order)

        <!-- list of all products in the order -->
        @include('includes.list_products', [ 'products' => $order['o_products'],
        'title' => 'Order #' . $order['id'] .' - £' . $order['o_total'],
        'quantity' => true, 'quantities' => $order['o_products_quantities'], 'order' => $order ] )
        <!-- list of all orders -->
      @endforeach
      <!-- end of list of all products in the order -->
    @else
      <!-- no orders message -->
      <div class="panel">
        <h2>Orders</h2>
        <p>No completed orders.</p>
      </div>
      <!-- end of no orders message -->
    @endif
  </div>
@endsection
