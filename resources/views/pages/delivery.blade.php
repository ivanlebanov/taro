@extends('layouts.app')

@section('title') Delivery @endsection

@section('content')
  <div class="container">
    <div class="col-sm-6">
      <div class="panel">
        <h2>Standard Delivery</h2>
		<br>
		<ul>
    <li>Free As Standard
		<li>3-5 Day Delivery
		<li>Royal Mail Delivered
		</ul>
		</p>
		<br>
		<p>Working days are Monday to Friday.
      </div>
    </div>
  </div>
  <div class="container">
    <div class="col-sm-6">
      <div class="panel">
        <h2>Express Delivery</h2>
		<br>
		<ul>
    <li>£4.99 Extra Charge
		<li>1-2 Day Delivery
		<li>Royal Mail Tracked Delivered
		</ul>
		</p>
		<br>
		<p>Working days are Monday to Friday.
      </div>
    </div>
  </div>
@endsection
