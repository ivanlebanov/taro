@extends('layouts.app')

@section('title') Login @endsection

@section('content')
  <div class="container">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="panel">
        <h2>Login</h2>
        <form class="login-form" method="POST" action="{{ url('/login') }}">
          {{ csrf_field() }}
          <!-- email field -->
          <input type="email" name="email" value="{{ old('email') }}"
          placeholder="E-mail&#42;" required autofocus>
          <!-- password field -->
          <input type="password" placeholder="Password&#42;" name="password" required>
          <!-- login button -->
          <button type="submit" class="btn red-btn">Login</button>
          <!-- reset password link -->
          <a class="btn link-btn" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
          <a class="btn dark-link-btn" href="{{ url('/register') }}">Don't have an account? Register</a>
        </form>
      </div>
    </div>
  </div>
@endsection
