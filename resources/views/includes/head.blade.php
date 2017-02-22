<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Taro - @yield('title')</title>
    <!-- Style -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
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
  @include('includes.header.main_navigation')
  @include('includes.header.subnavigation')
  @include('includes.header.cart_sidebar')
