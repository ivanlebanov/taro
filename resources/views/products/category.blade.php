@extends('layouts.app')

@section('title') {{$category['pc_name']}}  @endsection

@section('content')
  <!-- displaying latest products in the category using the template for listing products -->
  @if(count($latest_products) > 0)
    <div class="container">
        @include('includes.list_products', [ 'products' => $latest_products, 'title' => $category['pc_name'], 'extra_button' => true])
    </div>

    <div class="load_more_products">
    </div>

    <div class="row">
      <div class="container load_more">
        <button type="button" id="load_more" class="btn red-btn" data-offset="4"
                data-url="{{route('products.loadmore', ['category' => $category['pc_name'] ])}}">load more</button>
      </div>
    </div>
  @else
    @include('products.no_products')
  @endif
@endsection
