@extends('layouts.app')

@section('title') Home @endsection

@section('content')

  <div class="container">
    @if(count($products) > 0)
      <ul>
        @foreach($products as $product)
          <li>{{$product['p_name']}}  -  <strike>{{$product['p_price']}}</strike>{{$product['p_discount_price']}}$ </li>
        @endforeach
      </ul>
    @endif
  </div>

@endsection
