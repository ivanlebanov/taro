@extends('layouts.app')

@section('title') Your account @endsection

@section('content')
  <div class="container">
    <!-- Personal info form -->
    @include('user.forms.personal_info')
    <!-- end of personal info form -->
    <!-- address form -->
    @include('user.forms.address')
    <!-- end of address form -->
  </div>
@endsection
