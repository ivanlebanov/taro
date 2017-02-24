<!-- Sidebar -->
<div class="col-md-2 sidebar">
  <a class="navbar-brand" href="#">
    T<span>A</span>RO
  </a>

  <ul class="main-navigation">
    <?php $path = Route::currentRouteName(); ?>

    <li @if($path == "admin.products.get") class="active" @endif>
      <a href="{{ route('admin.products.get') }}">products</a>
    </li>
    <li @if($path == "admin.categories.get") class="active" @endif>
      <a href="{{ route('admin.categories.get') }}">categories</a>
    </li>
    <li  @if($path == "admin.users.get") class="active" @endif>
      <a href="{{ route('admin.users.get') }}">users</a>
    </li>
    <li @if($path == "admin.delivery_types.get") class="active" @endif>
      <a href="{{ route('admin.delivery_types.get') }}">delivery types</a>
    </li>
    <li @if($path == "admin.sliders.get") class="active" @endif>
      <a href="{{ route('admin.sliders.get') }}">sliders</a>
    </li>
  </ul>
</div>
