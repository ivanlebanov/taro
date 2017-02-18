<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::group(['middleware' => 'web'], function() {
  // Homepage
  Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

  // Products
  Route::get('/products/{category}', ['as' => 'products.category', 'uses' => 'ProductController@getCategoryPage']);
  Route::get('/product/{id}/{name}', ['as' => 'products.single_product', 'uses' => 'ProductController@getSingleProductPage']);
  Route::get('/product/{id}', ['as' => 'product.getData', 'uses' => 'ProductController@getSingleProduct']);
  Route::post('/search',['as' => 'search.phrase', 'uses' => 'SearchController@search']);
  Route::post('/search-results',['as' => 'search.results', 'uses' => 'SearchController@searchResults']);

  // Cart
  Route::get('/cart',['as' => 'cart.get', 'uses' => 'CartController@getCartPage']);
  Route::post('/product/{id}', ['as' => 'cart.add', 'uses' => 'CartController@add']);
  Route::delete('/product/{id}', ['as' => 'cart.delete', 'uses' => 'CartController@delete']);

  // Checkout
  Route::get('/checkout', ['as' => 'checkout.get', 'uses' => 'CheckoutController@getCheckoutPage']);
  Route::post('/checkout', ['as' => 'checkout.post', 'uses' => 'CheckoutController@placeOrder']);
  Route::get('/order_confirmed/{id}', ['as' => 'checkout.confirmed', 'uses' => 'CheckoutController@orderConfirmed']);
  // compare
  Route::post('/compare',['as' => 'compare.add', 'uses' => 'CompareController@add']);
  Route::delete('/compare',['as' => 'compare.delete', 'uses' => 'CompareController@remove']);
  Route::get('/compare',['as' => 'compare.get', 'uses' => 'CompareController@get']);
  //Basic authentication
  Auth::routes();

  // Static pages
  Route::get('/delivery',['as' => 'static.delivery', 'uses' => 'StaticPagesController@getDeliveryPage']);
  Route::get('/faq',['as' => 'static.faq', 'uses' => 'StaticPagesController@getFAQPage']);
  Route::get('/payments',['as' => 'static.payments', 'uses' => 'StaticPagesController@getPaymentPage']);
  Route::get('/customer-support',['as' => 'static.support', 'uses' => 'StaticPagesController@getSupportPage']);
  Route::get('/returns-refunds',['as' => 'static.refunds', 'uses' => 'StaticPagesController@getRefundPage']);

  //Contact us page
  Route::get('/contact-us',['as' => 'contact', 'uses' => 'ContactsController@getContactPage']);
  Route::post('/contact-us',['as' => 'sent_contact', 'uses' => 'ContactsController@saveContactForm']);

  // User account
  Route::get('/user-account', ['as' => 'profile.get_personal_info', 'uses' => 'UserController@profile']);
  Route::post('/user-account',['as' => 'profile.update_personal_info', 'uses' => 'UserController@savePersonalInfo']);
  Route::put('/user-acount',['as' => 'profile.update', 'uses' => 'UserController@update']);
  Route::post('/user-address',['as' => 'profile.update_address', 'uses' => 'UserController@saveAddress']);
  Route::post('/user-account/delivery',['as' => 'delivery.add', 'uses' => 'UserController@addDelivery']);
});
