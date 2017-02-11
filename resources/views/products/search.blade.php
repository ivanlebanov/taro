@extends('layouts.app')

@section('title') Search  @endsection

@section('content')
  @if(count($products) > 0)
    @include('includes.list_products', [ 'products' => $products, 'title' => 'Your search for: ' . $phrase ])
  @else
    <div class="container">
      <div class="col-md-5">
        <div class="panel">
          <h2>Your search for: {{$phrase}}</h2>
          <p>Nothing found.</p>
        </div>
      </div>
    </div>
  @endif
@endsection
