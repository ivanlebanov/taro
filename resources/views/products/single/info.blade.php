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
	  @if($product['p_stock'] == "" || $product['p_stock'] == 0 )
		<br>
		<p style="color:#ffaa00;font-size:70%;text-align:right;">None left in stock!</p>
	  @else
        @if($product['p_stock'] > 10)
          <p style="color:#f85f73;font-size:70%;text-align:right;">10+
        @else
          <p style="color:##f85f73;font-size:70%;text-align:right;">{{$product['p_stock']}}
        @endif
	    in stock</p>
      @endif
    </div>
	@if($product['p_stock'] == "" || $product['p_stock'] == 0 )
	<div class="row">
      <div class="col-md-6">
        <a href="#" class="btn link-btn add_to_wishlist" data-item-id="{{$product['p_id']}}"
                data-url="{{ route('wishlist.add')}}">Add to wishlist</a>
      </div>
    </div>
	@else
    <div class="row">
      <div class="col-md-2">
        <h3>Quantity:</h3>
      </div>
      <div class="col-md-10">
        <div class="select-style">
		@if($product['p_stock'] > 10)
          {{ Form::selectRange('quantity', 1, 10, null, ['class' => 'field', 'id' =>"quantity"]) }}
        @else
          {{ Form::selectRange('quantity', 1, $product['p_stock'], null, ['class' => 'field', 'id' =>"quantity"]) }}
        @endif
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <button type="button" class="btn big-btn red-btn add_to_cart_single"
                data-url="{{ route('cart.add', ['id' => $product['p_id'] ])}}">Add to basket</button>
      </div>
      <div class="col-md-6">
        <a href="#" class="btn link-btn add_to_wishlist" data-item-id="{{$product['p_id']}}"
                data-url="{{ route('wishlist.add')}}">Add to wishlist</a>
      </div>
    </div>
	@endif
    @if($product['p_user_manual_link'] != "")
      <a href="{{asset($product['p_user_manual_link'])}}" class="btn grey-link-btn" target="_blank">User Manual</a>
    @endif
  </div>
</div>
