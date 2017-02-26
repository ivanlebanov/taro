<!-- Sidebar -->
<div class="col-md-2 sidebar">
  <a class="navbar-brand" href="#">
    T<span>A</span>RO
  </a>

  <ul class="main-navigation">
    <?php $path = Route::currentRouteName(); ?>
    <li @if($path == "admin.orders.get" || $path == "admin.orders.editPage" ||
    $path == "admin.orders.addPage") class="active" @endif>
      <a href="{{ route('admin.orders.get') }}">orders</a>
    </li>
    <li @if($path == "admin.products.get" || $path == "admin.products.addPage"  ||
    $path == "admin.products.editPage") class="active" @endif>
      <a href="{{ route('admin.products.get') }}">products</a>
    </li>
    <li @if($path == "admin.categories.get" || $path == "admin.categories.addPage"  ||
    $path == "admin.categories.editPage") class="active" @endif>
      <a href="{{ route('admin.categories.get') }}">categories</a>
    </li>
    <li  @if($path == "admin.users.get" || $path =="admin.users.editPage") class="active" @endif>
      <a href="{{ route('admin.users.get') }}">users</a>
    </li>
    <li @if($path == "admin.delivery_types.get" || $path == "admin.delivery-types.editPage" ||
    $path == "admin.delivery-types.addPage") class="active" @endif>
      <a href="{{ route('admin.delivery_types.get') }}">delivery types</a>
    </li>
    <li @if($path == "admin.sliders.get" || $path == "admin.sliders.editPage" ||
    $path == "admin.sliders.addPage") class="active" @endif>
      <a href="{{ route('admin.sliders.get') }}">sliders</a>
    </li>
    <li @if($path == "admin.companies.get" || $path == "admin.companies.editPage" ||
    $path == "admin.companies.addPage") class="active" @endif>
      <a href="{{ route('admin.companies.get') }}">companies</a>
    </li>
  </ul>
</div>
