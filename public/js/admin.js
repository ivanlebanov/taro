function showErrorNotification(status, message){
  var notification = new NotificationFx({
    message : '<p>'  + message + ' </p>',
    layout : 'growl',
    effect : 'jelly',
    type : status
  });
  notification.show();
}

$('input, textarea').on("keyup", function() {
  $(this).removeClass('error');
});

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

function delete_category(url, elem) {
  makeAjaxCall("DELETE", url, null , true);
  elem.remove();
}
function delete_delivery_type(url, elem) {
  makeAjaxCall("DELETE", url, null , true);
  elem.remove();
}

function delete_user(url, elem) {
  makeAjaxCall("DELETE", url, null , true);
  elem.remove();
}

$('.delete_category').on('click', function(e){
  e.preventDefault();
  delete_category($(this).data('url'), $(this).closest('li'));
});

$('.delete_delivery_type').on('click', function(e){
  e.preventDefault();
  delete_delivery_type($(this).data('url'), $(this).closest('li'));
});
$('.delete_image_product').on('click', function(e){
  e.preventDefault();
  delete_delivery_type($(this).data('url'), $(this).closest('.row'));
});

$('.delete_user').on('click', function(e){
  e.preventDefault();
  delete_user($(this).data('url'), $(this).closest('li'));
});
