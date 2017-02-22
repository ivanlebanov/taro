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
