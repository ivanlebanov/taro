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

@if (session()->has('status'))
  <script>
    var data = <?php echo str_replace('&quot;', '"',  session('status') ) ?>;
    showErrorNotification(data.status, data.message);
  </script>
@endif
