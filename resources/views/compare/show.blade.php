@extends('layouts.app')

@section('title') Compare  @endsection

@section('content')
  <!-- displaying latest products in the category using the template for listing products -->
  @if(count($products) > 0)

        @include('includes.compare_products', [ 'products' => $products, 'title' => 'Comparing products' ])

  @else
    @include('products.no_products')
  @endif
@endsection
