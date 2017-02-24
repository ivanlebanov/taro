@extends('layouts.admin')

@section('title') Categories  @endsection

@section('content')
  <div class="col-md-9">
    <h1>Categories</h1>
  </div>
  <div class="col-md-3">
    <a href="#" class="btn red-btn">Add</a>
  </div>
  <div class="col-md-12">
    @if(count($categories) > 0)
      <div class="panel">
        <ul>

          @foreach($categories as $category)
            <li>{{ $category['pc_name'] }}</li>
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
