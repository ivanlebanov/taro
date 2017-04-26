@extends('layouts.app')

@section('title') Order successful  @endsection

@section('content')
  <div class="container">
    <div class="col-md-8">
      <!-- order success msg + cta button -->
      <div class="panel">
        <h2>Order has been successful #{{$order['id']}}</h2>
        <a href="#" data-url="{{ route('checkout.get-receipt', ['id' => $order['id'] ]) }}" class="btn red-btn get-receipt">your receipt</a>
      </div>
      <!-- end of order success msg-->
    </div>
  </div>
@endsection
