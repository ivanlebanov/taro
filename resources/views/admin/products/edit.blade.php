@extends('layouts.admin')

@section('title') Add a product  @endsection

@section('content')
  <div class="col-md-9">
    <h2>Products</h2>
  </div>
  <div class="col-md-3">

  </div>

  <div class="col-md-5">
    <div class="panel">
      <h2>Add a product</h2>
      {{ Form::open([ 'route' => ['admin.products.update', 'id' => $product['p_id']], 'files' => true, 'method' => 'PUT']) }}
        {{ Form::text('name', $product['p_name'], ['placeholder' => "Name*"] ) }}
        {{ Form::text('price', $product['p_price'], ['placeholder' => "Price*"] ) }}
        {{ Form::text('discount_price', $product['p_discount_price'], ['placeholder' => "Discount price"] ) }}
        {{ Form::text('discount_active', $product['p_discount_active'], ['placeholder' => "Active discount*"] ) }}
        {{ Form::text('description', $product['p_description'], ['placeholder' => "Description"] ) }}
        {{ Form::text('features', $product['p_features'], ['placeholder' => "Features"] ) }}
        {{ Form::text('sales', $product['p_sales'], ['placeholder' => "Sales*"] ) }}
        {{ Form::text('stock', $product['p_stock'], ['placeholder' => "Stock*"] ) }}
        <h3>User Manual Link:</h3>
        @if($product['p_user_manual_link'] != "")
          <div>
            <a href="{{$product['p_user_manual_link']}}" class="simple_link">File</a>
          </div>
        @endif
        <div>{{ Form::file('user_manual_link' ) }}</div>
        <h3>Thumbnail:</h3>
        <img src="{{asset( $product['p_thumb'] )}}" alt="">
        <div>{{ Form::file('thumb' ) }}</div>
        <h3>More images:</h3>
        @if(count($more_images) > 0)

          @foreach($more_images as $image)
            <div class="row">
              <div class="col-md-9">
                <img src="{{asset( $image['pi_image'] )}}" alt="">
              </div>
              <div class="col-md-3">
                <a href="#"  class="simple_link delete_image_product"
                  data-url="{{ route('admin.products.deleteImage', ['id' => $image['id']]) }}">
                delete
                </a>
              </div>
            </div>
          @endforeach

        @endif
        <div>{{ Form::file('additional_images[]', ['multiple' => 'multiple'] ) }}</div>

        @if(count($categories) > 0)
          <div class="select-style">
            {{ Form::select('category', $categories,  $product['category_id'], ['placeholder' =>  "Category"]) }}
          </div>
        @endif

        @if(count($companies) > 0)
          <div class="select-style">
            {{ Form::select('company', $companies,  $product['p_company_id'], ['placeholder' =>  "Company"]) }}
          </div>
        @endif

        {{ Form::submit('Save', ['class' => 'btn red-btn']) }}
      {{ Form::close() }}
    </div>
  </div>



@endsection
