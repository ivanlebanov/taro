<section class="product-list">
  @if(!isset($columns))
  <div class="container">
  @endif


    @foreach($products as $product)
      <div class="@if(isset($columns)) col-md-{{$columns}} @else col-md-3 @endif">
        <div class="product-wrapper">
          <a href="{{ route('products.single_product', ['id' => $product['p_id'], 'name' => str_slug($product['p_name']) ])}}">
            <img src="{{asset('img/products/' . $product['p_thumb'] )}}" alt="">
          </a>
          <div class="product-list-body">
            <h4>{{$product['p_name']}}</h4>
            <?php $product['p_features'] = array_slice( explode('|' , $product['p_features']), 0, 2); ?>
            @if(count($product['p_features']) > 0)
            <ul class="feature-list">

              @foreach($product['p_features'] as $feature)
                <li>{{$feature}}</li>
              @endforeach

            </ul>
            @endif
            <p>Quantity: {{$cart->$product['p_id']}} </p>
            <div class="price">
              @if($product['p_discount_active'] == 1)
                <strike>£{{$product['p_price']}}</strike> £{{$product['p_discount_price']}}
              @else
                £{{$product['p_price']}}
              @endif
            </div>
          </div>

          <div class="product-list-footer">
            <button type="button" class="btn grey-btn remove_from_cart"
            data-url="{{route('cart.delete', ['id' => $product['p_id'] ])}}">remove from cart</button>
          </div>
        </div>
      </div>
    @endforeach
    @if(!isset($columns))
    </div>
    @endif
</section>
