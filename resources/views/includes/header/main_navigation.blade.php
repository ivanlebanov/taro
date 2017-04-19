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
        <li class="dropdown">
          @if (Auth::guest())
            <a href="{{ url('/login') }}">
              <img src="{{asset('img/profile.png')}}" alt="user profile">
              Login / Register
            </a>
          @else
          <!-- link to user profile -->
            <a href="{{ route('profile.get_personal_info') }}">
              <img src="{{asset('img/profile.png')}}" alt="user profile icon">
              User account
            </a>
          @endif
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
              @if (!Auth::guest())
                <li>
                  <a href="{{ route('profile.get_personal_orders') }}">
                    Orders
                  </a>
                </li>
              @endif
            </ul>
        </li>
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
