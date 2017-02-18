function add_to_cart(url) {
  makeAjaxCall("POST", url, {} , true);
}
function remove_from_cart(url, elem) {
  makeAjaxCall("DELETE", url, {} , true);
  elem.remove();
}
function compare(p_id, url){
  makeAjaxCall("POST", url,{p_id:p_id}, true);
}
function reloadPage(ms){
  setTimeout(function(){
    location.reload();
  }, ms);
}
function makeAjaxCall(method, url, data, showError) {
  $.ajax({
      type: method,
      url: url,
      success: function(data){
        data = JSON.parse(data);
        if(showError)
          showErrorNotification(data.status, data.message);
          if(data.reload)
            reloadPage(2000);

      },
      data: data,
      headers: {
        'X-CSRF-TOKEN': window.Laravel.csrfToken
      }
  });
}

function searchResults(phrase, url){
  $.ajax({
      type: "POST",
      url: url,
      success: function(data){
        showSuggestions(data);
      },
      data: {phrase:phrase},
      headers: {
        'X-CSRF-TOKEN': window.Laravel.csrfToken
      }
  });
}

function showSuggestions(data) {
  $('.suggestions').empty();
  console.log(data);
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
    type : status
  });
  notification.show();
}

$('.remove_from_cart').on('click', function(){
  remove_from_cart($(this).data('url'), $(this).closest('.col-md-3 '));
});

$('input, textarea').on("keyup", function() {
  $(this).removeClass('error');
});

$('#search').on("keyup", function() {
  if($("#search").val().length > 1)
    searchResults($("#search").val(), $(this).data('url'));
  else
    $('.suggestions').empty();
});

$('.compare').on('click', function(){
  compare($(this).data('item-id'), $(this).data('url'));
});

$('.add_to_cart').on('click', function(){
  add_to_cart($(this).data('url'));
});
