<!-- more products wrappers -->
<div class="load_more_products"></div>
<!-- end of  more products wrappers -->

<!-- load more cta -->
<div class="row">
  <div class="container load_more">
    <button type="button" id="load_more" class="btn red-btn" data-offset="4"
            data-url="{{route('products.loadmore', ['category' => $category['pc_name'] ])}}">load more</button>
  </div>
</div>
<!-- end of load more cta -->
