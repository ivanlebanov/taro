@extends('layouts.app')

@section('title') Delivery @endsection

@section('content')
  <div class="container">
    <div class="col-sm-6">
      <!-- delivery panel -->
      <div class="panel">
        <h2>Standard Delivery</h2>
    		<br>
    		<ul>
          <li>Free As Standard</li>
      		<li>3-5 Day Delivery</li>
      		<li>Royal Mail Delivered</li>
    		</ul>
    		<br>
    		<p>Working days are Monday to Friday.</p>
      </div>
    </div>
  </div>
  <!-- end of delivery panel -->
  <!-- delivery panel -->
  <div class="container">
    <div class="col-sm-6">
      <div class="panel">
        <h2>Express Delivery</h2>
    		<br>
    		<ul>
        <li>£4.99 Extra Charge</li>
    		<li>1-2 Day Delivery</li>
    		<li>Royal Mail Tracked Delivered</li>
    		</ul>
    		</p>
    		<br>
    		<p>Working days are Monday to Friday.</p>
      </div>
    </div>
  </div>
  <!-- end of delivery panel -->
@endsection
