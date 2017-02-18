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

    <button type="button" class="btn big-btn red-btn add_to_cart"
            data-url="{{ route('cart.add', ['id' => $product['p_id'] ])}}">Buy now</button>
  </div>
</div>
