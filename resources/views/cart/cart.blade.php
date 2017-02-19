@extends('layouts.app')

@section('title') Bag  @endsection

@section('content')
  <div class="row">
    <div class="container">
      <div class="col-md-8">
        <h1>Bag (£{{$total}})</h1>
      </div>
      <div class="col-md-4">
        <a href="{{ route('checkout.get')}}" class="btn red-btn big-btn procced-btn">Proceed</a>
      </div>
      <div class="row">
        @include('includes.list_cart_products', [ 'products' => $products, 'title' => ''])
      </div>
    </div>
  </div>
@endsection
