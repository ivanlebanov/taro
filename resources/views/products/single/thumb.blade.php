<div class="col-md-6">
  <div class="gallery">
    <!-- main thumbnail -->
    <img id="main-image" src="{{asset( $product['p_thumb'] )}}" alt="">
    <div class="image-list row">
      <div class="col-md-3">
        <img src="{{asset( $product['p_thumb'] )}}" alt="">
      </div>
      @if(count($gallery) > 0)

        <!-- listing all addtional images -->
        @foreach($gallery as $image)
          <div class="col-md-3">
            <img src="{{asset( $image['pi_image'] )}}" alt="">
          </div>
        @endforeach
        <!-- end of listing all addtional images -->

      @endif
    </div>
  </div>


</div>
