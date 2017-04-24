@extends('layouts.admin')

@section('title') Companies  @endsection

@section('content')
  <div class="col-md-9">
    <h2>Companies</h2>
  </div>
  <div class="col-md-3">
    <a href="{{ route('admin.companies.addPage') }}" class="btn red-btn add-btn">Add</a>
  </div>
  <div class="col-md-12">
    @if(count($companies) > 0)
      <!-- list companies -->
      <div class="panel mini-panel">
        <ul class="admin-list">

          @foreach($companies as $company)
            <li>
              <div class="col-md-9">
                <a href="{{ route('admin.companies.editPage', ['id' => $company['id']]) }}" class="simple_link">
                  {{ $company['c_name'] }}
                </a>
              </div>
              <div class="col-md-3">
                <a href="#"  class="simple_link delete_category"
                  data-url="{{ route('admin.companies.delete', ['id' => $company['id']]) }}">
                delete
                </a>
              </div>
            </li>
          @endforeach

        </ul>
      </div>
      <!-- end of list companies -->
    @else
      <!-- no companies message -->
      <div class="panel">
        <h2>No companies</h2>
        <p>There are no companies so far. Why no add the first one?</p>
      </div>
      <!-- end of no companies message -->
    @endif
  </div>
@endsection
