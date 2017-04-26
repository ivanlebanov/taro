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
    <!-- listing features -->
    <ul class="feature-list">

      @foreach($product['p_features'] as $feature)
        <li>{{$feature}}</li>
      @endforeach

    </ul>
    <!-- end of listing features -->
    @endif
    
    <div class="price">
      @if($product['p_discount_active'] == 1)
        <strike>£{{$product['p_price']}}</strike> £{{$product['p_discount_price']}}
      @else
        £{{$product['p_price']}}
      @endif
  	  @if($product['p_stock'] == "" || $product['p_stock'] == 0 )
  		  <p class="no-stock">None left in stock!</p>
  	  @else
          @if($product['p_stock'] > 10)
            <p class="many-stock">10+ in stock</p>
          @else
            <p class="low-stock">{{$product['p_stock']}} in stock</p>
          @endif
      @endif
    </div>
	@if($product['p_stock'] == "" || $product['p_stock'] == 0 )
    <!-- add to wishlist cta -->
    <div class="row">
      <div class="col-md-6">
        <a href="#" class="btn link-btn add_to_wishlist" data-item-id="{{$product['p_id']}}"
                data-url="{{ route('wishlist.add')}}">Add to wishlist</a>
      </div>
    </div>
    <!-- end of add to wishlist cta -->
	@else
    <!-- quantity dropdown -->
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
    <!-- end of quantity dropdown -->
    <!-- cta buttons -->
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
    <!-- end of cta buttons -->
	@endif

    @if($product['p_user_manual_link'] != "")
        <!-- link to manual -->
      <a href="{{asset($product['p_user_manual_link'])}}" class="btn grey-link-btn" target="_blank">User Manual</a>
        <!-- end of link to manual -->
    @endif
  </div>
</div>
