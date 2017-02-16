@extends('layouts.app')

@section('title') Cart  @endsection

@section('content')
  <div class="row">
    <div class="container">
      <h1>Cart (£{{$total}})</h1>
      @include('includes.list_cart_products', [ 'products' => $products, 'title' => ''])
    </div>
  </div>
@endsection
