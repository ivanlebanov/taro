@extends('layouts.app')

@section('title') Contact us @endsection

@section('content')
  <div class="container">
    <h1>Contact us</h1>
    <div class="col-md-6">
      <div class="panel">
        <h2>Easiest way to get in touch with us.</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed semper mollis aliquet.
          Sed vestibulum aliquet imperdiet. Nam non pharetra odio. Sed vitae elit risus.</p>
        {{ Form::open(['route' => 'sent_contact' ]) }}
          {{ Form::token() }}
          {{ Form::text('subject', null, ['placeholder' =>  "Subject*"]) }}
          {{ Form::textarea('message', null, ['placeholder' =>  "Message*"] ) }}
          {{ Form::submit('Save', ['class' => 'btn red-btn']) }}
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
