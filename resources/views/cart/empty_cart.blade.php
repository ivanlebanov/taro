@extends('layouts.app')

@section('title') Cart  @endsection

@section('content')
  <div class="container">
    <div class="col-md-5">
      <div class="panel">
        <h2>Cart</h2>
        <p>No nothing to see here yet.</p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="container">
      @include('includes.list_products', [ 'products' => $products, 'title' => 'Some products you might like:'])
    </div>
  </div>
@endsection
