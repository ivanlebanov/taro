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
function compare_delete(p_id, url, elem){
  makeAjaxCall("DELETE", url,{p_id:p_id}, true);
  elem.remove();
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

function showPopup(url, url2){
  $.ajax({
      type: "GET",
      url: url,
      success: function(data){
        data = JSON.parse(data);
        console.log(data);
        $('#gallery-popup').html('<div class="item" style="background-image:url(' + "/img/products/" + data.p_thumb +')"></div>');
        $('#title-popup').html(data.p_name);
        $('#description-popup').html(data.p_description);
        $('#buy-popup').data('item-id', data.p_id);
        $('#buy-popup').data('url', url2);

        var features = data.p_features.split(" | ");
        $('#feature-list-popup').empty();

        for (var i = 0; i < features.length; i++) {
          $('#feature-list-popup').append('<li>' + features[i] + '</li>');
        }

        if(data.p_discount_active)
          $('#price-popup').html('<strike>£' + data.p_price + '</strike> £' + data.p_discount_price);
        else
          $('#price-popup').html("£" + data.p_price);
        $('.overlay').show();
        $('.popup').show();
      },
      headers: {
        'X-CSRF-TOKEN': window.Laravel.csrfToken
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

$('.popup .close').on('click', function(){
  $('.popup').hide();
  $('.overlay').hide();
});
$('#search').on("keyup", function() {
  if($("#search").val().length > 1)
    searchResults($("#search").val(), $(this).data('url'));
  else
    $('.suggestions').empty();
});

$('.show-popup').on('click', function(){
  showPopup($(this).data('url2'), $(this).data('url'));
});
$('.compare').on('click', function(){
  compare($(this).data('item-id'), $(this).data('url'));
});
$('.compare_delete').on('click', function(){
  compare_delete($(this).data('item-id'), $(this).data('url'), $(this).closest('.col-md-3 '));
});

$('.add_to_cart').on('click', function(){
  add_to_cart($(this).data('url'));
});
