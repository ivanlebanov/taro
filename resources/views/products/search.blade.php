@extends('layouts.app')

@section('title') Search  @endsection

@section('content')
  @if(count($products) > 0)
    <div class="container">
      @if($exactmatch)
        <!-- exact match products -->
        @include('includes.list_products', [ 'products' => $products, 'title' => 'Your search for "' . $phrase . '" returned ' . count($products) . ' result(s):' ])
        <!-- end of exact match products -->
      @else
        <!-- no exact match found -->
        @include('includes.list_products', [ 'products' => $products, 'title' => "We didn't find an exact match for  " . $phrase  . ". Products you may like:"])
        <!-- end of no exact match found -->
      @endif
    </div>
  @else
    <!-- nothing relevant found -->
    <div class="container">
      <div class="col-md-7">
        <div class="panel">
          <h2>Your search for: {{$phrase}}</h2>
          <p>Nothing found. Why not check out some <a href="{{ route('products.category', ['category' => 'Laptops' ])}}" class="simple_link">Laptops?</a></p>
        </div>
      </div>
    </div>
    <!-- end of nothing relevant found -->
  @endif
@endsection
