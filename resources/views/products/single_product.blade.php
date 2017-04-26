@extends('layouts.app')

@section('title')  {{$product['p_name']}} @endsection

@section('content')
  <div class="row">
    <div class="container single_product">
      <!-- thumbnail + related images -->
      @include('products.single.thumb')
      <!-- end of thumbnail + related images -->
      <!-- basic info subview -->
      @include('products.single.info')
      <!-- end of basic info subview -->
    </div>
    <!-- List related products -->
    <div class="container">
      @include('includes.list_products', [
      'products' => $relatedproducts,
      'title' => 'You might like:'
      ])
    </div>
    <!-- end of List related products -->
  </div>

@endsection
