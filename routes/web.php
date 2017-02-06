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
  Route::post('/search',['as' => 'search.phrase', 'uses' => 'SearchController@search']);
  Route::post('/search-results',['as' => 'search.results', 'uses' => 'SearchController@searchResults']);

  //Basic authentication
  Auth::routes();

  // Static pages
  Route::get('/delivery',['as' => 'static.delivery', 'uses' => 'StaticPagesController@getDeliveryPage']);
  Route::get('/faq',['as' => 'static.faq', 'uses' => 'StaticPagesController@getFAQPage']);
  Route::get('/payments',['as' => 'static.payments', 'uses' => 'StaticPagesController@getPaymentPage']);
  Route::get('/customer-support',['as' => 'static.support', 'uses' => 'StaticPagesController@getSupportPage']);
  Route::get('/returns-refunds',['as' => 'static.refunds', 'uses' => 'StaticPagesController@getRefundPage']);

  // User account
  Route::get('/user-account', ['as' => 'profile.get_personal_info', 'uses' => 'UserController@profile']);
  Route::post('/user-account',['as' => 'profile.update_personal_info', 'uses' => 'UserController@savePersonalInfo']);
  Route::post('/user-address',['as' => 'profile.update_address', 'uses' => 'UserController@saveAddress']);
});
