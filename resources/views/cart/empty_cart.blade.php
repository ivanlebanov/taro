@extends('layouts.app')

@section('title') Bag  @endsection

@section('content')
  <div class="container">
    <div class="col-md-5">
      <!-- no products added message -->
      <div class="panel">
        <h2>Bag</h2>
        <p>Nothing to see here yet.</p>
      </div>
      <!-- end of no products message -->
    </div>
  </div>
  <!-- suggested products -->
  <div class="row">
    <div class="container">
      @include('includes.list_products', [ 'products' => $products, 'title' => 'Some products you might like:'])
    </div>
  </div>
  <!-- end of suggested products -->
@endsection
