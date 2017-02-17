@extends('layouts.app')

@section('title') Checkout  @endsection

@section('content')
  <div class="container">

    @include('checkout.title')
    @include('checkout.personal_and_address')
    @include('checkout.delivery_form')

  </div>
@endsection
