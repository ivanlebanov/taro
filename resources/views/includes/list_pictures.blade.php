<section class="product-list">
  <div class="container">
  <h3>{{$title}}</h3>

    @foreach($products as $product)
      <div class="col-md-3">
        <div class="product-wrapper">
          <a href="#">
            <img src="{{asset('img/slider/slider_image_1.png')}}" alt="">
          </a>
          <div class="product-list-body">
            <h4>{{$product['p_name']}}</h4>
            <?php $product['p_features'] = explode('|' , $product['p_features']); ?>
            @if(count($product['p_features']) > 0)
            <ul class="feature-list">

              @foreach($product['p_features'] as $feature)
                <li>{{$feature}}</li>
              @endforeach
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

          <div class="product-list-footer">
            <button data-item-id='{{$product['p_id']}}' type="button" class="btn grey-btn compare">compare</button>
            <button type="button" class="btn red-btn">quick buy</button>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>
