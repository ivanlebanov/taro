@extends('layouts.app')

@section('title') Frequently Asked Questions @endsection

@section('content')
<div class="container">
    <h1>FAQ</h1>
    <div class="col-md-12">
        <!--
        In order for the collapsing of Questions to work, all content must be
        within the lastElementChild of its "panel"
        -->
        <div class="panel">
            <img src="{{asset('img/arrow_down.png')}}" alt="arrow" class="faq_arrow"/>
            <h2>Title 1</h2>
            <p>This is the first FAQ entry</p>
        </div>
        <div class="panel">
            <img src="{{asset('img/arrow_down.png')}}" alt="arrow" class="faq_arrow"/>
            <h2>Title 2</h2>
            <p>This is the second FAQ entry</p>
        </div>
        <div class="panel">
            <img src="{{asset('img/arrow_down.png')}}" alt="arrow" class="faq_arrow"/>
            <h2>Title 3</h2>
            <p>This is the third FAQ entry</p>
        </div>
        <div class="panel">
            <img src="{{asset('img/arrow_down.png')}}" alt="arrow" class="faq_arrow"/>
            <h2>Where do you ship to?</h2>
            <p>This is the fourth FAQ entry</p>
        </div>
        <div class="panel">
            <img src="{{asset('img/arrow_down.png')}}" alt="arrow" class="faq_arrow"/>
            <h2>Who do I contact about an order?</h2>
            <p>This is the fifth FAQ entry</p>
        </div>
    </div>
</div>
@endsection

<script src="{{ asset('js/faq.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/style_rob.css')}}">
