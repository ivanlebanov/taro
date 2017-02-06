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

  Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

  Route::get('/products/{category}', ['as' => 'products.category', 'uses' => 'ProductController@getCategoryPage']);
  Route::get('/product/{id}/{name}', ['as' => 'products.single_product', 'uses' => 'ProductController@getSingleProductPage']);
  Route::post('/search',['as' => 'search.phrase', 'uses' => 'SearchController@search']);
  Route::post('/search-results',['as' => 'search.results', 'uses' => 'SearchController@searchResults']);
  Auth::routes();

  Route::get('/home', 'HomeController@index');
  Route::get('/user-account', ['as' => 'profile.get_personal_info', 'uses' => 'UserController@profile']);
  Route::post('/user-account',['as' => 'profile.update_personal_info', 'uses' => 'UserController@savePersonalInfo']);
  Route::post('/user-address',['as' => 'profile.update_address', 'uses' => 'UserController@saveAddress']);
});
