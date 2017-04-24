@extends('layouts.admin')

@section('title') Delivery types  @endsection

@section('content')

  <div class="col-md-9">
    <h2>Delivery types</h2>
  </div>
  <div class="col-md-3">
    <a href="{{ route('admin.delivery-types.addPage') }}" class="btn red-btn add-btn">Add</a>
  </div>
  <div class="col-md-12">
    @if(count($deliveries) > 0)
      <!-- listing delivery types -->
      <div class="panel mini-panel">
        <ul class="admin-list">

          @foreach($deliveries as $delivery)
            <li>
              <div class="col-md-9">
                <a href="{{ route('admin.delivery-types.editPage', ['id' => $delivery['id']]) }}" class="simple_link">
                  {{ $delivery['dt_name'] }}
                </a>
              </div>
              <div class="col-md-3">
                <a href="#"  class="simple_link delete_delivery_type"
                  data-url="{{ route('admin.delivery-types.delete', ['id' => $delivery['id']]) }}">
                delete
                </a>
              </div>
            </li>
          @endforeach

        </ul>
      </div>
      <!-- end of listing delivery types -->
    @else
      <!-- no delivery types message -->
      <div class="panel">
        <h2>No delivery types</h2>
        <p>There are no categories so far. Why no add the first one?</p>
      </div>
      <!-- end of no delivery types message -->
    @endif
  </div>

@endsection
