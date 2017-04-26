  <!-- javascript admin libs -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="{{ asset('js/notificationFx.js') }}"></script>
  <script src="{{ asset('js/admin.js') }}"></script>
  <!-- end of javascript admin libs -->
  <!-- errors scripts -->
  @include('includes.errors')
  <!-- end of errors scripts -->
  <!-- addtional scripts -->
  @yield('page_footer')
  <!-- end of addtional scripts -->
</body>
</html>
