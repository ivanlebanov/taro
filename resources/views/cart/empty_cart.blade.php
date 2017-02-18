@extends('layouts.app')

@section('title') Bag  @endsection

@section('content')
  <div class="container">
    <div class="col-md-5">
      <div class="panel">
        <h2>Bag</h2>
        <p>Nothing to see here yet.</p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="container">
      @include('includes.list_products', [ 'products' => $products, 'title' => 'Some products you might like:'])
    </div>
  </div>
@endsection
