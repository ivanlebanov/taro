@extends('layouts.app')

@section('title') Order successful  @endsection

@section('content')
  <div class="container">
    <div class="col-md-8">
      <div class="panel">
        <h2>Order has been successful #{{$order['id']}}</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          Nulla egestas massa at nunc sodales, quis tristique ex scelerisque.
          Fusce ullamcorper libero quis finibus molestie. Mauris non congue tellus.</p>
          <a href="#" data-url="{{ route('checkout.get-receipt', ['id' => $order['id'] ]) }}" class="btn red-btn get-receipt">your receipt</a>
      </div>
    </div>
  </div>
@endsection
