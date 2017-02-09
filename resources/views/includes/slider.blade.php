@if(count($slider) > 0 )
  <section class="gallery autoplay items-{{count($slider)}}">
    @foreach($slider as $key => $slider_item)
      <div id="item-{{$key + 1}}" class="control-operator"></div>
    @endforeach

    @foreach($slider as $key => $slider_item)
      <figure class="item" style="background-image:url({{asset($slider_item['s_image'])}});">
        <!-- Previous/next icons -->

        @if($key != 0)
          <a href="#item-{{$key }}" class="prev-item">
            <img src="{{asset('img/arrow_left.png')}}" alt="">
          </a>
        @else
          <a href="#item-{{count($slider)}}" class="prev-item">
            <img src="{{asset('img/arrow_left.png')}}" alt="">
          </a>
        @endif
        @if($key != count($slider) - 1)
          <a href="#item-{{$key + 2}}" class="next-item">
            <img src="{{asset('img/arrow_right.png')}}" alt="">
          </a>
        @else
          <a href="#item-1" class="next-item">
            <img src="{{asset('img/arrow_right.png')}}" alt="">
          </a>
        @endif

        <!-- Heading and link -->
        <h2>
          <a href="{{$slider_item['s_link']}}">
            {{$slider_item['s_title']}}
          </a>
        </h2>
      </figure>
    @endforeach
    <!-- Circle icons -->
    <div class="controls">

      @foreach($slider as $key => $slider_item)
        <a href="#item-{{$key + 1}}" class="control-button">•</a>
      @endforeach

    </div>
  </section>
@endif
