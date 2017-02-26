@extends('layouts.admin')

@section('title') Orders  @endsection

@section('content')
  <div class="col-md-9">
    <h2>Orders</h2>
  </div>
  <div class="col-md-3">
  </div>
  <div class="col-md-12">
    @if(count($orders) > 0)
      <div class="panel mini-panel">
        <ul class="admin-list">

          @foreach($orders as $order)
            <li>
              <div class="col-md-9">
                <a href="{{ route('admin.orders.editPage', ['id' => $order['id']]) }}" class="simple_link">
                  {{ "Order for £" . $order['o_total'] . " by " . $order['user']['name'] }}
                </a>
              </div>
              <div class="col-md-3">
                <a href="#"  class="simple_link delete_category"
                  data-url="{{ route('admin.orders.delete', ['id' => $order['id']]) }}">
                delete
                </a>
              </div>
            </li>
          @endforeach

        </ul>
      </div>
    @else
      <div class="panel">
        <h2>No orders</h2>
        <p>There are no orders so far.</p>
      </div>
    @endif
  </div>
@endsection
