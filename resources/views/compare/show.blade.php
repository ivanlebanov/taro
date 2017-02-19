@extends('layouts.app')

@section('title') Compare  @endsection

@section('content')
  <!-- displaying latest products in the category using the template for listing products -->
  @if(count($products) > 0)

        @include('includes.compare_products', [ 'products' => $products, 'title' => 'Comparing products' ])

  @else

  <div class="container">
    <div class="col-md-5">
      <div class="panel">
        <h2>Compare</h2>
        <p>No products added for comparison.</p>
      </div>
    </div>
  </div>

  @endif
@endsection
