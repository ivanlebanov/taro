@extends('layouts.admin')

@section('title') Sliders  @endsection

@section('content')


  <div class="col-md-9">
    <h2>Sliders</h2>
  </div>
  <div class="col-md-3">
    <a href="{{ route('admin.sliders.addPage') }}" class="btn red-btn add-btn">Add</a>
  </div>
  <div class="col-md-12">
    @if(count($sliders) > 0)
      <div class="panel mini-panel">
        <ul class="admin-list">

          @foreach($sliders as $slider)
            <li>
              <div class="col-md-9">
                <a href="{{ route('admin.sliders.editPage', ['id' => $slider['id']]) }}" class="simple_link">
                  {{ $slider['s_title'] }}
                </a>
              </div>
              <div class="col-md-3">
                <a href="#"  class="simple_link delete_delivery_type"
                  data-url="{{ route('admin.sliders.delete', ['id' => $slider['id']]) }}">
                delete
                </a>
              </div>
            </li>
          @endforeach

        </ul>
      </div>
    @else
      <div class="panel">
        <h2>No sliders</h2>
        <p>There are no sliders so far. Why no add the first one?</p>
      </div>
    @endif
  </div>

@endsection
