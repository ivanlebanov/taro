<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Taro</title>

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
    <div id="app">
        <nav class="navbar">
          <div class="container">
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {!! config('app.name', 'Laravel') !!}
            </a>
            <!-- Right Side Of Navbar -->
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
                  <a href="#">
                    <img src="{{asset('img/profile.png')}}" alt="user profile icon">
                    User account
                  </a>
                </li>
              @endif
              <!-- link to the bag -->
              <li>
                <a href="#">
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
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->

</body>
</html>
