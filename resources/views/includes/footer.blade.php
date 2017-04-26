<!-- footer -->
  <footer>
    <div class="container">
      <div class="top-footer-section">
        <div class="col-lg-6 info-footer">
          <div class="navbar-brand">T<span>A</span>RO</div>
          <p>Taro is an online marketplace for computer goods and accessories.
              We aim to provide high quality service to our customers, and
              offer great prices on great products. If you experience any
              problems, please <a href="{{ route('contact') }}">contact us here.</a></p>
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
                <a href="{{ route('static.payments') }}">Payment Options</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-6">
            <ul>
              <li>
                <a href="{{ route('static.support') }}">Customer Support</a>
              </li>
              <li>
                <a href="{{ route('contact') }}">Contact Us</a>
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
      <small>&copy; 2017 Taro Industries Ltd; All Rights Reserved.</small>
    </div>
  </footer>
  <!-- javascript general libs -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="{{ asset('js/notificationFx.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  <!-- end of javascript admin libs -->
  @include('includes.errors')
  <!-- additional scripts -->
  @yield('page_footer')
  <!-- end of additional scripts -->
</body>
</html>
