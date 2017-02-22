@extends('layouts.app')

@section('title') Search  @endsection

@section('content')
  @if(count($products) > 0)
    <div class="container">
      @if($exactmatch)
        @include('includes.list_products', [ 'products' => $products, 'title' => 'Your search for "' . $phrase . '" returned ' . count($products) . ' result(s):' ])
      @else
        @include('includes.list_products', [ 'products' => $products, 'title' => "We didn't find an exact match for  " . $phrase  . ". Products you may like:"])
      @endif
    </div>
  @else
    <div class="container">
      <div class="col-md-7">
        <div class="panel">
          <h2>Your search for: {{$phrase}}</h2>
          <p>Nothing found. Why not check out some <a href="{{ route('products.category', ['category' => 'Laptops' ])}}" class="simple_link">Laptops?</a></p>
        </div>
      </div>
    </div>
  @endif
@endsection
