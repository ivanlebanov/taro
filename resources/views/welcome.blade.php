@extends('layouts.app')

@section('content')

  <div class="content">
    @if(count($products) > 0)
      <ul>
        @foreach($products as $product)
          <li>{{$product['p_name']}} -  <strike>{{$product['p_price']}}</strike>{{$product['p_discount_price']}}$ </li>
        @endforeach
      </ul>
    @endif
  </div>

@endsection
