function add_to_cart(url) {
  $.ajax({
      type: "POST",
      url: url,
      success: function(data){
        data = JSON.parse(data);

        showErrorNotification(data.status, data.message);
      },

      data: {},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
}


function compare(p_id, url){
  $.ajax({
      type: "POST",
      url: url,
      success: function(data){
        data = JSON.parse(data);

        showErrorNotification(data.status, data.message);
      },

      data: {p_id:p_id},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
}


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

function showSuggestions(data) {
  $('.suggestions').empty();

  for (var i = 0; i < data.length; i++) {
    $('.suggestions').append("<li><a href='" + data[i].url + "'>" +
    "<img src='/img/products/"+ data[i].p_thumb +"'>" +  data[i].p_name  + "</a></li>");
  }
  
}


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




$('input, textarea').on("keyup", function() {
  $(this).removeClass('error');
});
$('#search').on("keyup", function() {
  if($("#search").val().length > 2){
    searchResults($("#search").val(), $(this).data('url'));
  }
});
$('.compare').on('click', function(){
  compare($(this).data('item-id'), $(this).data('url'));
});

$('.add_to_cart').on('click', function(){
  add_to_cart($(this).data('url'));
});
