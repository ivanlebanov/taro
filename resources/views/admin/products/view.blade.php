@extends('layouts.admin')

@section('title') Products  @endsection

@section('content')

<div class="col-md-9">
  <h2>Products</h2>
</div>
<div class="col-md-3">
  <a href="{{ route('admin.products.addPage') }}" class="btn red-btn add-btn">Add</a>
</div>
<div class="col-md-12">
  @if(count($products) > 0)
    <div class="panel mini-panel">
      <ul class="admin-list">

        <!-- listing all products -->
        @foreach($products as $product)
          <li>
            <div class="col-md-9">
              <a href="{{ route('admin.products.editPage', ['id' => $product['p_id']]) }}" class="simple_link">
                {{ $product['p_name'] }}
              </a>
            </div>
            <div class="col-md-3">
              <a href="#"  class="simple_link delete_category"
                data-url="{{ route('admin.products.delete', ['id' => $product['p_id']]) }}">
              delete
              </a>
            </div>
          </li>
        @endforeach
        <!-- end of listing all products -->

      </ul>
    </div>

  @else
  <!-- no products message -->
    <div class="panel">
      <h2>No products</h2>
      <p>There are no products so far. Why no add the first one?</p>
    </div>
  @endif
</div>

@endsection
