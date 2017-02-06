@extends('layouts.app')

@section('title') Your account @endsection

@section('content')
  <div class="container">
    @include('user.forms.personal_info')
    @include('user.forms.address')
  </div>
@endsection
