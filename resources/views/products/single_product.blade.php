@extends('layouts.app')

@section('title')  {{$product['p_name']}} @endsection

@section('content')
  <div class="row">
    <div class="container single_product">
      <div class="col-md-6">
        <div class="gallery">
          <img src="{{asset('img/products/' . $product['p_thumb'] )}}" alt="">
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel">
          <h1>
            {{$product['p_name']}}
            <span>
              in
              <a class="simple_link" href="{{ route('products.category', ['category' => $category['pc_name'] ])}}">
                {{$category['pc_name']}}
              </a>
              by {{$company['c_name']}}

            </span>
          </h1>
          <p>{{$product['p_description']}}</p>
          <?php $product['p_features'] = explode('|' , $product['p_features']); ?>
          @if(count($product['p_features']) > 0)
          <ul class="feature-list">

            @foreach($product['p_features'] as $feature)
              <li>{{$feature}}</li>
            @endforeach
          </ul>
          @endif
          <div class="price">
          @if($product['p_discount_active'] == 1)
            <strike>£{{$product['p_price']}}</strike> £{{$product['p_discount_price']}}
          @else
            £{{$product['p_price']}}
          @endif
          </div>
          <button type="button" class="btn big-btn red-btn add_to_cart">Buy now</button>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="container">
      @include('includes.list_products', [ 'products' => $relatedproducts, 'title' => 'You might like:'])
    </div>
  </div>
@endsection
