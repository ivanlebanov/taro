@extends('layouts.app')

@section('title') Wishlist  @endsection

@section('content')
  <!-- displaying latest products in the category using the template for listing products -->
  @if(count($products) > 0)

        @include('includes.wishlist_products', [ 'products' => $products, 'title' => 'Your wishlist' ])

  @else
    <div class="container">
      <div class="col-md-5">
        <div class="panel">
          <h2>Wishlist</h2>
          <p>Nothing to see here yet. Start adding products to the wishlist and you'll see them here.</p>
        </div>
      </div>
    </div>
  @endif
@endsection
