@extends('layouts.app')

@section('title') Payment @endsection

@section('content')
  <div class="container">
    <div class="col-sm-6">
      <!-- Payment methods panel -->
      <div class="panel">
        <h2>Payment</h2>
        <p>We accept the following payment methods:</p><br>
        <p>
          <ul>
            <li>PayPal&reg;</li>
            <li>Visa&reg;</li>
            <li>MasterCard&reg;</li>
            <li>American Express&reg;</li>
            <li>Delta&reg;</li>
            <li>Maestro&reg;</li>
          </ul>
        </p>
      </div>
      <!-- end of Payment methods panel -->
    </div>
  </div>
@endsection
