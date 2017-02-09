@extends('layouts.app')

@section('title') Reset Password @endsection


<!-- Main Content -->
@section('content')
  <div class="container">
    <div class="col-md-3"> </div>
    <div class="col-md-6">
        <div class="panel">
          <h2>Reset Password</h2>

          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

          <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
            {{ csrf_field() }}

            <input type="email" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required>

            <button type="submit" class="btn red-btn">Send Password Reset Link</button>
          </form>
        </div>
      </div>
  </div>
@endsection
