@extends('layouts.admin')

@section('title') Categories  @endsection

@section('content')
  <div class="col-md-9">
    <h2>Categories</h2>
  </div>
  <div class="col-md-3">
    <a href="{{ route('admin.categories.addPage') }}" class="btn red-btn add-btn">Add</a>
  </div>
  <div class="col-md-12">
    @if(count($categories) > 0)
      <div class="panel mini-panel">
        <ul class="admin-list">

          @foreach($categories as $category)
            <li>
              <div class="col-md-9">
                <a href="{{ route('admin.categories.editPage', ['id' => $category['pc_id']]) }}" class="simple_link">
                  {{ $category['pc_name'] }}
                </a>
              </div>
              <div class="col-md-3">
                <a href="#"  class="simple_link delete_category"
                  data-url="{{ route('admin.categories.delete', ['id' => $category['pc_id']]) }}">
                delete
                </a>
              </div>
            </li>
          @endforeach

        </ul>
      </div>
    @else
      <div class="panel">
        <h2>No categories</h2>
        <p>There are no categories so far. Why no add the first one?</p>
      </div>
    @endif
  </div>
@endsection
