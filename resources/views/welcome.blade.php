@extends('layouts.app')

@section('title') Home @endsection

@section('content')
  <!-- including the slider -->
  @include('includes.slider')
  <!-- displaying 4 latest products on sale using the template for listing products -->
  @include('includes.list_pictures', [ 'products' => $on_sale, 'title' => 'On Sale'])

  <!-- displaying 4 most bought products using the template for listing products -->
  @include('includes.list_pictures', [ 'products' => $best_sellers, 'title' => 'Best sellers'])

@endsection
@section('page_footer')
  <script type="text/javascript">
    var url = window.location.href;
    if (url.indexOf('#') == -1){
      url += '#item-1';
      window.location.href = url;
    }
  </script>
@endsection
