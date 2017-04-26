@extends('layouts.app')

@section('title') Bag  @endsection

@section('content')
  <div class="row">
    <div class="container">
      <!-- heading -->
      <div class="col-md-8">
        <h1>Bag (£<span id="cart-total">{{$total}}</span>)</h1>
      </div>
      <!-- end of heading -->
      <!-- cta button -->
      <div class="col-md-4">
        <a href="{{ route('checkout.get')}}" class="btn red-btn big-btn procced-btn">Proceed</a>
      </div>
      <!-- end of cta button -->
      <div class="row">
        <!-- cart products -->
        @include('includes.list_cart_products', [ 'products' => $products, 'title' => ''])
        <!-- end of cart products -->
      </div>
    </div>
  </div>
@endsection
