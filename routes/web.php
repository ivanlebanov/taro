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

  // Admin Categories
  Route::get('/admin/categories', ['as' => 'admin.categories.get', 'uses' => 'Admin\AdminCategoryController@getCategories']);
  Route::get('/admin/category/{id}', ['as' => 'admin.categories.editPage', 'uses' => 'Admin\AdminCategoryController@editCategory']);
  Route::get('/admin/category/', ['as' => 'admin.categories.addPage', 'uses' => 'Admin\AdminCategoryController@addCategory']);
  Route::delete('/admin/category/{id}', ['as' => 'admin.categories.delete', 'uses' => 'Admin\AdminCategoryController@delete']);
  Route::put('/admin/category/{id}', ['as' => 'admin.categories.update', 'uses' => 'Admin\AdminCategoryController@update']);
  Route::post('/admin/category/', ['as' => 'admin.categories.add', 'uses' => 'Admin\AdminCategoryController@add']);


  Route::get('/admin/users', ['as' => 'admin.users.get', 'uses' => 'Admin\AdminUsersController@getUsers']);
  Route::get('/admin/products', ['as' => 'admin.products.get', 'uses' => 'Admin\AdminProductsController@getProducts']);
  Route::get('/admin/delivery-types', ['as' => 'admin.delivery_types.get', 'uses' => 'Admin\AdminDeliveryTypesController@getDeliveryTypes']);
  Route::get('/admin/sliders', ['as' => 'admin.sliders.get', 'uses' => 'Admin\AdminSlidersController@getSliders']);


  // Products
  Route::get('/products/{category}', ['as' => 'products.category', 'uses' => 'ProductController@getCategoryPage']);
  Route::get('/products/{category}/loadmore', ['as' => 'products.loadmore', 'uses' => 'ProductController@loadMore']);
  Route::get('/product/{id}/{name}', ['as' => 'products.single_product', 'uses' => 'ProductController@getSingleProductPage']);
  Route::get('/product/{id}', ['as' => 'product.getData', 'uses' => 'ProductController@getSingleProduct']);


  // Search
  Route::get('/search',['as' => 'search.phrase', 'uses' => 'SearchController@search']);
  Route::post('/search-results',['as' => 'search.results', 'uses' => 'SearchController@searchResults']);

  // Cart
  Route::get('/cart',['as' => 'cart.get', 'uses' => 'CartController@getCartPage']);
  Route::get('/cart/contents', ['as' => 'cart.getcontents', 'uses' => 'CartController@getCartContents']);
  Route::post('/product/{id}', ['as' => 'cart.add', 'uses' => 'CartController@add']);
  Route::put('/product/{id}', ['as' => 'cart.update', 'uses' => 'CartController@update']);
  Route::delete('/product/{id}', ['as' => 'cart.delete', 'uses' => 'CartController@delete']);

  // Checkout
  Route::get('/checkout', ['as' => 'checkout.get', 'uses' => 'CheckoutController@getCheckoutPage']);
  Route::post('/checkout', ['as' => 'checkout.post', 'uses' => 'CheckoutController@placeOrder']);
  Route::get('/order_confirmed/{id}', ['as' => 'checkout.confirmed', 'uses' => 'CheckoutController@orderConfirmed']);

  // compare
  Route::post('/compare',['as' => 'compare.add', 'uses' => 'CompareController@add']);
  Route::delete('/compare',['as' => 'compare.delete', 'uses' => 'CompareController@remove']);
  Route::get('/compare',['as' => 'compare.get', 'uses' => 'CompareController@get']);

  // wishlist
  Route::post('/wishlist',['as' => 'wishlist.add', 'uses' => 'WishlistController@add']);
  Route::delete('/wishlist',['as' => 'wishlist.delete', 'uses' => 'WishlistController@remove']);
  Route::get('/wishlist',['as' => 'wishlist.get', 'uses' => 'WishlistController@get']);

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
