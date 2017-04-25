@extends('layouts.app')

@section('title') Contact us @endsection

@section('content')
  <div class="container">
    <h1>Contact us</h1>
    <div class="col-md-6">
      <div class="panel">
        <h2>Easiest way to get in touch with us.</h2>
        <p>Send us a direct message using the form below with your query or issue,
        and we will reply to you as soon as we can.</p>
        <p>Please ensure your email address for your account is up to date, as this is
        where we will reply to.</p>
        {{ Form::open(['route' => 'sent_contact' ]) }}
          {{ Form::token() }}
          {{ Form::text('subject', null, ['placeholder' =>  "Subject*"]) }}
          {{ Form::textarea('message', null, ['placeholder' =>  "Message*"] ) }}
          {{ Form::submit('Send', ['class' => 'btn red-btn']) }}
        {{Form::close()}}
      </div>
    </div>

    <div class="col-md-6">
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOSw4OnaR7IPAW8SBNwE1uAUjF-oBGxyA&amp"></script>
      <div id="map" class="map">

      </div>
    </div>

  </div>
@endsection
@section('page_footer')
  <script src="{{ asset('js/map.js') }}"></script>
@endsection
