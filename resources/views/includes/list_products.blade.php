<section class="product-list">
  @if(!isset($columns))
  <div class="container">
  @endif
  <h3>{{$title}}</h3>

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
              @if(isset($quantity))
                <p>Quantity: {{$quantities[$product['p_id']]}} </p>
              @endif
              <div class="price">
              
              @if($product['p_discount_active'] == 1)
                <strike>£{{$product['p_price']}}</strike> £{{$product['p_discount_price']}}
              @else
                £{{$product['p_price']}}
              @endif
              </div>
            </ul>
            @endif
          </div>
          @if(!isset($quantity))
          <div class="product-list-footer">
            <button data-item-id='{{$product['p_id']}}' type="button" class="btn grey-btn compare"
            data-url="{{route('compare.add')}}">compare</button>
            <button  data-url="{{ route('cart.add', ['id' => $product['p_id'] ])}}"
            data-url2="{{route('product.getData', ['id' => $product['p_id'] ])}}" type="button" class="btn red-btn show-popup">quick buy</button>
          </div>
          @endif
        </div>
      </div>
    @endforeach
    @if(!isset($columns))
    </div>
    @endif
</section>
