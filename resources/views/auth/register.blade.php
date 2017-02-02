@extends('layouts.app')

@section('title') Register @endsection

@section('content')
  <div class="container">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
      <div class="panel">
        <h2>Register</h2>
        <form method="POST" action="{{ url('/register') }}">
          {{ csrf_field() }}
          <!-- name field -->
          <input type="text" placeholder="Name&#42;" name="name" value="{{ old('name') }}"  autofocus>
           <!-- email field -->
          <input type="text" placeholder="Email&#42;" name="email" value="{{ old('email') }}" >
          <!-- password field -->
          <input type="password" placeholder="Password&#42;" name="password" >
          <!-- confirm password field -->
          <input type="password" placeholder="Confirm password&#42;" name="password_confirmation" >

          <button type="submit" class="btn red-btn">Register</button>
          <a class="btn link-btn" href="{{ url('/login') }}">Have an account? Login.</a>
        </form>
      </div>
    </div>
  </div>

@endsection
