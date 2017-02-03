@extends('layouts.app')

@section('title') Reset Password @endsection

@section('content')
  <div class="container">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="panel">
          <h2>Reset Password</h2>

          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

          <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <input type="email" placeholder="E-Mail Address" name="email" value="{{ $email or old('email') }}" required autofocus>

            <input type="password" placeholder="Password" name="password" required>

            <input type="password" placeholder="Confirm Password" name="password_confirmation" required>

            <button type="submit" class="btn red-btn">Reset Password</button>

          </form>
        </div>
    </div>
  </div>

@endsection
