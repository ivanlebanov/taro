@extends('layouts.app')

@section('title') Checkout  @endsection

@section('content')
  <div class="container">
    <!-- checkout contents -->
    @include('checkout.title')
    @include('checkout.personal_and_address')
    @include('checkout.delivery_form')
    <!-- end of checkout contents -->
  </div>
@endsection
