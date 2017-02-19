<div class="col-md-6">
  <div class="gallery">
    <img id="main-image" src="{{asset('img/products/' . $product['p_thumb'] )}}" alt="">
    <div class="image-list row">
      <div class="col-md-3">
        <img src="{{asset('img/products/' . $product['p_thumb'] )}}" alt="">
      </div>
      @if(count($gallery) > 0)
        @foreach($gallery as $image)
          <div class="col-md-3">
            <img src="{{asset('img/products/' . $image['pi_image'] )}}" alt="">
          </div>
        @endforeach
      @endif
    </div>
  </div>


</div>
