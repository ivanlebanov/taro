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
        //bttn.disabled = false;
      }
    });
    notification.show();
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
  <script type="text/javascript">
    $('#search').on("keyup", function() {

      if($("#search").val().length > 2){
        searchResults($("#search").val(), $(this).data('url'));
      }
    });
    function searchResults(phrase, url){
      $.ajax({
          type: "POST",
          url: url,
          success: function(data){
            console.log(data);
            showSuggestions(data);
          },

          data: {phrase:phrase},
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

    }
  </script>
  <script type="text/javascript">
    $('.compare').on('click', function(){
      compare($(this).data('item-id'), $(this).data('url'));
    });
    function compare(p_id, url){
      $.ajax({
          type: "POST",
          url: url,
          success: function(data){
            data = JSON.parse(data);
            console.log(data);
            showErrorNotification(data.status, data.message);
          },

          data: {p_id:p_id},
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    }
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
