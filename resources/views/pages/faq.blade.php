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
            <h2>What is Taro?</h2>
            <p>TARO is a brand new website that allows you to buy a variety of
              different technology products. </p>
        </div>
        <div class="panel">
            <img src="{{asset('img/arrow_down.png')}}" alt="arrow" class="faq_arrow"/>
            <h2>How do I place an order?</h2>
            <p>To place an order, simply search for an item using the bar above,
            or use one of the categories if you want to browse for a product. Click quick
            buy, or if you want more detail, click on the product. If you wish to proceed,
             click buy and proceed with the purchase.</p>
        </div>
        <div class="panel">
            <img src="{{asset('img/arrow_down.png')}}" alt="arrow" class="faq_arrow"/>
            <h2>What is your returns policy?</h2>
            <p>Our returns policy and be found on the
               <a href=../returns-refunds class="simple_link">
                 Returns/Refunds</a> page</p>
        </div>
        <div class="panel">
            <img src="{{asset('img/arrow_down.png')}}" alt="arrow" class="faq_arrow"/>
            <h2>Where do you ship to?</h2>
            <p>We offer courier shipping throught the UK and USA.</p>
        </div>
        <div class="panel">
            <img src="{{asset('img/arrow_down.png')}}" alt="arrow" class="faq_arrow"/>
            <h2>Who do I contact about an order?</h2>
            <p>If you need to get in touch, visit the
               <a href=../contact-us class="simple_link">
                 Contact Us</a> page</p>
        </div>
    </div>
</div>
@endsection

<link rel="stylesheet" href="{{ asset('css/style_rob.css')}}">
