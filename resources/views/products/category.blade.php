@extends('layouts.app')

@section('title') {{$category['pc_name']}}  @endsection

@section('content')
  <!-- displaying latest products in the category using the template for listing products -->
  @if(count($latest_products) > 0)
    <div class="container">
        @include('includes.list_products', [ 'products' => $latest_products, 'title' => $category['pc_name'], 'extra_button' => true])
    </div>


    @include('products.load_more')
  @else
    <!-- no products -->
    @include('products.no_products')
    <!-- end of no products -->
  @endif
@endsection
