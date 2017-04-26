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
      <!-- Add products form -->
      {{ Form::open([ 'route' => ['admin.products.add'], 'files' => true]) }}
        {{ Form::text('name', null, ['placeholder' => "Name*"] ) }}
        {{ Form::text('price', null, ['placeholder' => "Price*"] ) }}
        {{ Form::text('discount_price', null, ['placeholder' => "Discount price"] ) }}
        {{ Form::text('discount_active', null, ['placeholder' => "Active discount*"] ) }}
        {{ Form::text('description', null, ['placeholder' => "Description"] ) }}
        {{ Form::text('features', null, ['placeholder' => "Features"] ) }}
        {{ Form::text('sales', null, ['placeholder' => "Sales*"] ) }}
        {{ Form::text('stock', null, ['placeholder' => "Stock*"] ) }}
        <h3>User Manual Link:</h3>
        <div>{{ Form::file('user_manual_link' ) }}</div>
        <h3>Thumbnail:</h3>
        <div>{{ Form::file('thumb' ) }}</div>
        <h3>More images:</h3>
        <div>{{ Form::file('additional_images[]', ['multiple' => 'multiple'] ) }}</div>

        <!-- categories dropdown -->
        @if(count($categories) > 0)
          <div class="select-style">
            {{ Form::select('category', $categories,  $product['category_id'], ['placeholder' =>  "Category"]) }}
          </div>
        @endif

        <!-- companies dropdown -->
        @if(count($companies) > 0)
          <div class="select-style">
            {{ Form::select('company', $companies,  $product['p_company_id'], ['placeholder' =>  "Company"]) }}
          </div>
        @endif

        {{ Form::submit('Save', ['class' => 'btn red-btn']) }}
      {{ Form::close() }}
      <!-- end of Add category form -->
    </div>
  </div>



@endsection
