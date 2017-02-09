@extends('layouts.app')

@section('title') Search  @endsection

@section('content')

  @include('includes.list_products', [ 'products' => $products, 'title' => 'Your search for: ' . $phrase ])
@endsection
