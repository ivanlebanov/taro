@extends('layouts.admin')

@section('title') Users  @endsection

@section('content')
  <div class="col-md-9">
    <h2>Users</h2>
  </div>
  <div class="col-md-3">

  </div>
  <div class="col-md-12">
    @if(count($users) > 0)
      <div class="panel mini-panel">
        <ul class="admin-list">

          @foreach($users as $user)
            <li>
              <div class="col-md-9">
                <a href="{{ route('admin.users.editPage', ['id' => $user['id']]) }}" class="simple_link">
                  {{ $user['email'] }}
                </a>
              </div>
              <div class="col-md-3">
                <a href="#"  class="simple_link delete_user"
                  data-url="{{ route('admin.users.delete', ['id' => $user['id']]) }}">
                delete
                </a>
              </div>
            </li>
          @endforeach

        </ul>
      </div>
    @else
      <div class="panel">
        <h2>No users</h2>
        <p>There are no users so far.</p>
      </div>
    @endif
  </div>
@endsection
