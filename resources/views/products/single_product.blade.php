@extends('layouts.app')

@section('title')  {{$product['p_name']}} @endsection

@section('content')
  <div class="row">
    <div class="container single_product">
      @include('products.single.thumb')
      @include('products.single.info')
    </div>
    <!-- List related products -->
    <div class="container">
      @include('includes.list_products', [
      'products' => $relatedproducts,
      'title' => 'You might like:'
      ])
    </div>
  </div>

@endsection
