<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Taro - @yield('title')</title>
    <!-- Style -->
    <link href="/css/style.css" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
        @if(!isset($categories))
          @inject('categories', 'App\Services\Categories')
        @endif

        @include('products.quick_add')
        <nav class="navbar">
          <div class="container">
            <!-- Branding Image -->
            <div class="col-md-2">
              <a class="navbar-brand" href="{{ url('/') }}">
                  {!! config('app.name', 'Laravel') !!}
              </a>
            </div>
            <!-- Search bar -->
            <div class="col-md-5">
              {{ Form::open(['route' => 'search.phrase', 'method' => 'GET'])}}
                {{ Form::text('phrase', null, ['placeholder' => 'Search', 'id' => 'search', 'autocomplete' => 'off' ,'data-url' => route('search.results') ]) }}
                {{ Form::submit('', ['class' => 'red-search-icon']) }}
              {{ Form::close()}}
              <ul class="suggestions">
              </ul>
            </div>
            <!-- Right Side Of Navbar -->
            <div class="col-md-5">
              <ul>
                <!-- Authentication Links -->
                @if (Auth::guest())
                  <li>
                    <a href="{{ url('/login') }}">
                      <img src="{{asset('img/profile.png')}}" alt="user profile">
                      Login / Register
                    </a>
                  </li>
                @else
                <!-- link to user profile -->
                  <li>
                    <a href="{{ route('profile.get_personal_info') }}">
                      <img src="{{asset('img/profile.png')}}" alt="user profile icon">
                      User account
                    </a>
                    <ul class="dropdown-list">
                      <li>
                        <a href="{{ route('compare.get') }}">
                          Compare
                        </a>
                      </li>
                      <li>
                        <a href="{{ route('wishlist.get') }}">
                          Wishlist
                        </a>
                      </li>
                    </ul>
                  </li>
                @endif
                <!-- link to the bag -->
                <li>
                  <a href="#" data-url="{{route('cart.getcontents')}}" class="cart_trigger">
                    <img src="{{asset('img/bag.png')}}" alt="user bag icon">
                    Bag
                  </a>
                </li>
                @if (!Auth::guest())
                  <!-- Log out link -->
                  <li>
                    <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                      <img src="{{asset('img/logout.png')}}" alt="logout icon">
                      Logout
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                  </li>
                @endif
              </ul>
            </div>
          </div>
        </nav>
        <nav class="sumbenu">
          <div class="container">
            <ul>

                @foreach($categories->categories as $key => $category)
                  <li>
                    <a href="{{ route('products.category', ['category' => $category['pc_name'] ])}}">
                      {{$category['pc_name']}}
                    </a>
                  </li>
                @endforeach

            </ul>
          </div>
        </nav>

        <aside class="cart_sidebar">
          <h2>Bag</h2>
          <div class="close-cart-sidebar">
            <img src="{{asset('img/close-white.png')}}" alt="close icon">
          </div>
          <ul class="items">

          </ul>
          <div class="price">

          </div>
          <a href="{{route('cart.get')}}" class="btn big-btn red-btn">
            See bag and proceed
          </a>
        </aside>
