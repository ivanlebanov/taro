function add_to_cart(url) {
  makeAjaxCall("POST", url, {} , true);
}
function add_to_cart_single(url, quantity) {
  makeAjaxCall("POST", url, {quantity:quantity} , true);
}
function decline_order(url) {
  makeAjaxCall("POST", url, {} , true);
  reloadPage(1000);
}

function update_cart(url, quantity, increase, elem, button, second_button) {
  $.ajax({
      type: "PUT",
      url: url,
      success: function(data){
        data = JSON.parse(data);
        showErrorNotification(data.status, data.message);
        if(data.status == 'success'){
            elem.text(quantity);
            if(increase === true){
              $(button).data("qty", quantity + 1);
              $(second_button).data("qty", quantity - 1);
            }else{

              $(button).data("qty", quantity + 1);
              $(second_button).data("qty", quantity - 1);
            }

        }
      },
      data: {quantity:quantity},
      headers: {
        'X-CSRF-TOKEN': window.Laravel.csrfToken
      }
  });
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
function changeMainImage(src) {
  $('#main-image').attr('src', src);
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

        $('#gallery-popup').html('<div class="item" style="background-image:url('  + data.p_thumb +')"></div>');
        $('#title-popup').html(data.p_name);
        $('#description-popup').html(data.p_description);
        $('#buy-popup').data('item-id', data.p_id);
        $('#buy-popup').data('url', url2);

        var features = data.p_features.split(" | ");
        $('#feature-list-popup').empty();

        for (var i = 0; i < features.length; i++) {
          $('#feature-list-popup').append('<li>' + features[i] + '</li>');
        }
        if(data.gallery.length > 0){
          $('.gallery-poup-links').show();
          $('.gallery-poup-links').append("<li class='active' data-src='" + data.p_thumb + "'></li>");

          for (var g = 0; g < data.gallery.length; g++) {
            $('.gallery-poup-links').append("<li data-src='" + data.gallery[g].pi_image + "'></li>");
          }

        }else{
          $('.gallery-poup-links').show();
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

function changeTotal(url, elem) {

  $.ajax({
      type: "GET",
      url: url,
      async: false,
      success: function(data){
        data = JSON.parse(data);

        $('#cart-total').html(data.total);
      }
    });
}

function showCartContents(url){
  $.ajax({
      type: "GET",
      url: url,
      success: function(data){
        data = JSON.parse(data);

        $('.cart_sidebar .items').empty();
        if(data.products.length > 0){
          for (var i = 0; i < data.products.length; i++) {
            $('.cart_sidebar .items').append("<li><a href='" + data.products[i].url + "'>" +
            "<img src='"+ data.products[i].p_thumb +"'>" +
            data.cart[data.products[i].p_id] + " * " +  data.products[i].p_name  +
            "</a></li>");
          }
        }else{
            $('.cart_sidebar .items').append("<li>No items in the bag.</li>");
        }

        $('.cart_sidebar .price').html("Total: £" + data.total);
        $('.cart_sidebar').show();
        $('.overlay').show();
      }
    });
}

function showSuggestions(data) {
  $('.suggestions').empty();

  for (var i = 0; i < data.length; i++) {
    $('.suggestions').append("<li><a href='" + data[i].url + "'>" +
    "<img src='"+ data[i].p_thumb +"'>" +  data[i].p_name  + "</a></li>");
  }

}
function showFaq(e){
    var elem = this.parentElement.lastElementChild;
    var currentDis = elem.style.display;
    if(currentDis == "block"){
        e.target.src = "/img/arrow_down.png";
        elem.style.display = "none";
    }else{
        e.target.src = "/img/arrow_up.png";
        elem.style.display = "block";
    }
}

function connectListeners(){
    var arrows = document.querySelectorAll(".faq_arrow");

    for (let arrow of arrows){
        arrow.addEventListener("click", showFaq);
    }
}

window.addEventListener("load", connectListeners);
function loadMore(url, offset, mode) {
  $.ajax({
      type: "GET",
      url: url,
      data: { "offset": offset, "filter": mode } ,
      success: function(data){

        if (/^[\],:{}\s]*$/.test(data.replace(/\\["\\\/bfnrtu]/g, '@').
        replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
        replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
          data = JSON.parse(data);
          showErrorNotification(data.status, data.message);
          $('#load_more').remove();
        }else{
          $('.load_more_products').append(data);

        }


      },
      headers: {
        'X-CSRF-TOKEN': window.Laravel.csrfToken
      }

      });
}

function getReceipt(url) {
  $.ajax({
      type: "GET",
      url: url,
      success: function(data){

        if (/^[\],:{}\s]*$/.test(data.replace(/\\["\\\/bfnrtu]/g, '@').
        replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
        replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
          data = JSON.parse(data);
          showErrorNotification(data.status, data.message);

        }else{
          location.replace(data);


        }


      },
      headers: {
        'X-CSRF-TOKEN': window.Laravel.csrfToken
      }

      });
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
function changeImagePopup(src, elem) {
  $('#gallery-popup .item').css('background-image', 'url(' + src + ")");
  $('.gallery-poup-links li').removeClass('active');
  elem.addClass('active');
}
$('body').on('click', '.gallery-poup-links li', function(){
  changeImagePopup($(this).data('src'), $(this));
});
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

$('.decline_order').on('click', function(e){
  e.preventDefault();
  decline_order($(this).data('url'));
});
$('.add_to_wishlist').on('click', function(e){
  e.preventDefault();
  compare($(this).data('item-id'), $(this).data('url'));
});
$('#load_more').on('click', function(e){
  e.preventDefault();
  loadMore($(this).data('url'), $(this).data('offset'), $('.extra_button').val());
  var newoffset = $(this).data('offset') + 4;
  $(this).data('offset', newoffset);

});

$('.wishlist_delete').on('click', function(){
  compare_delete($(this).data('item-id'), $(this).data('url'), $(this).closest('.col-md-3 '));
});
$('.compare_delete').on('click', function(){
  compare_delete($(this).data('item-id'), $(this).data('url'), $(this).closest('.col-md-3 '));
});
$('.image-list img').on('click', function(){
  changeMainImage($(this).attr('src'));
});

$('.add_to_cart').on('click', function(){
  add_to_cart($(this).data('url'));
});
$('.cart_trigger').on('click', function(){
  showCartContents($(this).data('url'));
});
$('.close-cart-sidebar').on('click', function(){
  $('.overlay').hide();
  $('.cart_sidebar').hide();
});
$('.overlay').on('click', function(){
  $('.cart_sidebar').hide();
  $('.overlay').hide();
  $('.popup').hide();
});
$('.add_to_cart_single').on('click', function(){
  add_to_cart_single($(this).data('url'), $("#quantity").val());
});
$('.get-receipt').on('click', function(){
  getReceipt($(this).data('url'));
});
$('.qty-increase').on('click', function(e){
  e.preventDefault();
  update_cart($(this).data('url'), $(this).data('qty'),true,
  $('#prod-' + $(this).data('id')), $(this), $(this).closest('.col-md-3').find('.qty-decrease'));
  var cart_url = $(this).data('url-cart');
  setTimeout(function(){
    changeTotal(cart_url , $('#cart-total'));
  }, 1000);
});
$('.qty-decrease').on('click', function(e){
  e.preventDefault();
  update_cart($(this).data('url'), $(this).data('qty'),false,
   $('#prod-' + $(this).data('id')), $(this).closest('.col-md-3').find('.qty-increase'), $(this));
   var cart_url = $(this).data('url-cart');
   setTimeout(function(){
     changeTotal(cart_url , $('#cart-total'));
   }, 1000);
});
