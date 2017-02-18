<h2>Orders</h2>
@if(count($orders) > 0)

  @foreach($orders as $key => $order)

    @include('includes.list_products', [ 'products' => $order['o_products'],
    'title' => 'Order #' . $order['id'] .' - £' . $order['o_total'],
    'quantity' => true, 'quantities' => $order['o_products_quantities'] ] )

  @endforeach

@else
    <p>No completed orders.</p>
@endif
