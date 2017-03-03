<!-- Scripts -->
  <footer>
    <div class="container">
      <div class="top-footer-section">
        <div class="col-lg-6 info-footer">
          <div class="navbar-brand">T<span>A</span>RO</div>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Nulla egestas massa at nunc sodales, quis tristique ex scelerisque.
            Fusce ullamcorper libero quis finibus molestie. Mauris non congue tellus.</p>
        </div>
        <div class="col-lg-6">
          <div class="col-lg-6">
            <ul>
              <li>
                <a href="{{ route('static.delivery') }}">Delivery</a>
              </li>
              <li>
                <a href="{{ route('static.faq') }}">FAQ</a>
              </li>
              <li>
                <a href="{{ route('static.payments') }}">Payment options</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-6">
            <ul>
              <li>
                <a href="{{ route('static.support') }}">Customer support</a>
              </li>
              <li>
                <a href="{{ route('contact') }}">Contact us</a>
              </li>
              <li>
                <a href="{{ route('static.refunds') }}">Refunds/Returns</a>
              </li>
            </ul>
          </div>

        </div>

      </div>
    </div>
    <div class="copyrights">
      <small>All rights reserved 2017</small>
    </div>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="{{ asset('js/notificationFx.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  <script src="{{ asset('js/faq.js') }}"></script>
  @include('includes.errors')
  @yield('page_footer')
</body>
</html>
