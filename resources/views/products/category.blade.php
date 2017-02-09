@extends('layouts.app')

@section('title') {{$category['pc_name']}}  @endsection

@section('content')
  <!-- displaying latest products in the category using the template for listing products -->
  @if(count($latest_products) > 0)
    <div class="container">
      @include('products.sidebar')
      <div class="col-md-9">
        @include('includes.list_products', [ 'products' => $latest_products, 'title' => $category['pc_name'], 'columns' => '4'])
      </div>
    </div>
  @else
    @include('products.no_products')
  @endif
@endsection
