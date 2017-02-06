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
                <a href="#">Delivery</a>
              </li>
              <li>
                <a href="#">FAQ</a>
              </li>
              <li>
                <a href="#">Payment options</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-6">
            <ul>
              <li>
                <a href="#">Customer support</a>
              </li>
              <li>
                <a href="#">Contact us</a>
              </li>
              <li>
                <a href="#">Refunds/Returns</a>
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
  <script src="{{ asset('js/modernizr.custom.js') }}"></script>
  <script src="{{ asset('js/classie.js') }}"></script>
  <script src="{{ asset('js/notificationFx.js') }}"></script>
  <script>
  function showErrorNotification(status, message){
  var notification = new NotificationFx({
    message : '<p>'  + message + ' </p>',
    layout : 'growl',
    effect : 'jelly',
    type : status, // notice, warning, error or success
    onClose : function() {
      bttn.disabled = false;
    }
  });
  notification.show();
}

// show the notification


</script>
  <script type="text/javascript">
  var compareButtons = document.getElementsByClassName("compare");

  function compare() {
    var item_id = this.getAttribute("data-item-id");
    var comparelist = localStorage.compareList;
    if(comparelist.length == 2)
      showNotificationError('success', 'We will show you differences side to side.');
    for (var i = 0; i < comparelist.length; i++) {
      if(comparelist[i] == item_id)
        showNotificationError('error', 'Items has been added.');
      else
        showNotificationError('error', 'Items has been added.');
    }
  };

  for (var i = 0; i < compareButtons.length; i++) {
    compareButtons[i].addEventListener('click', compare, false);
  }
  </script>


  @if ( $errors->count() > 0 )

  <script type="text/javascript">
  	var html_error = 	'<p>The following errors have occurred:</p><ul>';
  			var has_error = false;
        var keys = new Array();
  			@foreach( $errors->getMessages() as $key => $message )
  		   	has_error = true;
          keys.push("{{$key}}");
  				html_error += '<li>' + " {{ $message[0] }} " + '</li>';
  			@endforeach
  		html_error += '</ul>';
      for (var i = 0; i < keys.length; i++) {
        $('input[name="' + keys[i] + '"]').addClass('error');
        $('textarea[name="' + keys[i] + '"]').addClass('error');
        $('select[name="' + keys[i] + '"]').closest('.select-style').addClass('error');
      }
  		if(has_error){
  			showErrorNotification('error', html_error);
  		}

  </script>

  @endif
  <script type="text/javascript">
  $('input, textarea').on("keyup", function() {
    $(this).removeClass('error');
  });
  </script>
  @if (session()->has('status'))

    <script>
      var data = <?php echo str_replace('&quot;', '"',  session('status') ) ?>;
      showErrorNotification(data.status, data.message);
    </script>
  @endif
  @yield('page_footer')
</body>
</html>
