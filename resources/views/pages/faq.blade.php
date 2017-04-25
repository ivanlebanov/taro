@extends('layouts.app')

@section('title') Frequently Asked Questions @endsection

@section('content')
<div class="container">
    <h1>FAQ</h1>
    <div class="col-md-12 faq">
        <!--
        In order for the collapsing of Questions to work, all content must be
        within the lastElementChild of its "panel"
        -->
        <div class="panel">
            <img src="{{asset('img/arrow_down.png')}}" alt="arrow" class="faq_arrow"/>
            <h2>What is Taro?</h2>
            <p>TARO is a brand new website that allows you to buy a variety of
              different technology products.</p>
        </div>
        <div class="panel">
            <img src="{{asset('img/arrow_down.png')}}" alt="arrow" class="faq_arrow"/>
            <h2>How Do I place an Order?</h2>
            <p>To place an order, simply search for an item using the bar above,
            or use one of the categories if you want to browse for a product. Click quick
            buy, or if you want more detail, click on the product. If you wish to proceed,
             click buy and proceed with the purchase.</p>
        </div>
        <div class="panel">
            <img src="{{asset('img/arrow_down.png')}}" alt="arrow" class="faq_arrow"/>
            <h2>What Is Your Returns Policy?</h2>
            <p>Our returns policy and be found on the
               <a href=../returns-refunds class="simple_link">
                 Returns/Refunds</a> page</p>
        </div>
        <div class="panel">
            <img src="{{asset('img/arrow_down.png')}}" alt="arrow" class="faq_arrow"/>
            <h2>Where Do You Ship To?</h2>
            <p>We offer courier shipping throught the UK and USA.</p>
        </div>
        <div class="panel">
            <img src="{{asset('img/arrow_down.png')}}" alt="arrow" class="faq_arrow"/>
            <h2>Who Do I Contact About an Order?</h2>
            <p>If you need to get in touch, visit the
               <a href="{{ route('contact') }}" class="simple_link">
                 Contact Us</a> page</p>
        </div>
        <div class="panel">
            <img src="{{asset('img/arrow_down.png')}}" alt="arrow" class="faq_arrow"/>
            <h2>How Do I Compare Items?</h2>
            <p>Simply click "compare" on the two items that you would like to compare.
            Once done, navigate to the Compare page, which can be found in the drop-down
            list under "User Account".</p>
        </div>
    </div>
</div>
@endsection
