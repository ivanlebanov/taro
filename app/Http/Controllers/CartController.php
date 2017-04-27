<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product as Product;
use Cookie;

class CartController extends Controller
{
    /**
    * Reads the contents of a users cart from a cookie and returns it to the application
    *
    * @return JSON $data
    */
  public function getCartContents()
  {
    $data['cart'] = json_decode(Cookie::get('cart'));
    if($data['cart'] != null){
      $ids =  array_keys(get_object_vars($data['cart']));
      $data['products'] = Product::whereIn('p_id', $ids)->get();
      $data['total'] = $this->calculateTotal($data['products'], $data['cart']);

      if(count($data['products']) > 0){
        foreach ($data['products'] as $key => $product) {
          $data['products'][$key]['url'] = route('products.single_product', ['id' => $product['p_id'], 'name' => str_slug($product['p_name']) ]);
        }
      }
    }else {
      $data['products'] = [];
      $data['total'] = 0;
    }

    return json_encode($data);
  }

  /**
  *
  *
  * @param Request $request The request object from the client
  * @param String $id The p_id of the product to be added to the cart
  * @return String $status A message confirming the status of the action
  */
  public function add(Request $request, $id)
  {
    $inputs = $request->input();
    if(!isset($inputs['quantity']))
      $inputs['quantity'] = 1;
    $cart = json_decode(Cookie::get('cart'));
    $cartData = array();
    // validation if the product is in stock
    $product = Product::where('p_id', $id)->first();

    $quantity = isset($cart->$id) ? $cart->$id + $inputs['quantity'] : $inputs['quantity'];

    // validation check for availability
    if($product['p_stock'] == "" || $product['p_stock'] < $quantity)
      return error_msg('There is not enough stock');

    // validation if the exceeds maximum number of items
    $cart_quantity = $this->getCartQuantity($cart);
    if($cart_quantity + $inputs['quantity'] > 50)
      return error_msg('Maximum items in the cart is 50');


    if(!$cart){
      $cartData[$id] = 1;
      $cartData = json_encode($cartData);
    }else{

      if( property_exists($cart, $id) )
        $cart->$id = $cart->$id + $inputs['quantity'];
      else
        $cart->$id = $inputs['quantity'];

      $cartData = json_encode($cart);
    }

    Cookie::queue('cart', $cartData, 600000);

    // success message in json format for the UI
    $status = success_msg('Product successfully added to the bag');

    return $status;

  }

  /**
  * Updates the quantity of an item in the users basket
  *
  * @param Request $request The request object from the client
  * @param String $id The p_id of the product to be updated
  * @return String $status A message confirming the status of the action
  */
  public function update(Request $request, $id)
  {
    $inputs = $request->input();
    if(!isset($inputs['quantity']))
      $inputs['quantity'] = 1;
    $cart = json_decode(Cookie::get('cart'));
    $cartData = array();
    // validation if the product is in stock
    $product = Product::where('p_id', $id)->first();

    $quantity =  $inputs['quantity'];

    // validation check for availability
    if($product['p_stock'] == "" || $product['p_stock'] < $quantity)
      return error_msg('There is not enough stock');

    // validation if the exceeds maximum number of items
    $cart_quantity = $this->getCartQuantity($cart);
    if($cart_quantity + $inputs['quantity'] > 50)
      return error_msg('Maximum items in the cart is 50');

    if($inputs['quantity'] == 0)
      return error_msg('If you want to remove the product - please click the remove button');

    if(!$cart){
      $cartData[$id] = $inputs['quantity'];
      $cartData = json_encode($cartData);
    }else{

      if( property_exists($cart, $id) )
        $cart->$id = $inputs['quantity'];


      $cartData = json_encode($cart);
    }

    Cookie::queue('cart', $cartData, 600000);

    // success message in json format for the UI
    $status = success_msg('Product quantity successfully updated');

    return $status;

  }

  /**
  * Deletes an item from the users basket
  *
  * @param Request $request The request object from the client
  * @param String $id The p_id of the product to be deleted
  * @return String $status A message confirming the status of the action
  */
  public function delete(Request $request, $id)
  {
    $cart = json_decode(Cookie::get('cart'));
    $cartData = array();

    foreach ($cart as $product_id => $quantity) {
      if($product_id !== $id)
        $cartData[$product_id] = $quantity;
    }

    $cartData = json_encode($cartData);
    Cookie::queue('cart', $cartData, 600000);


    // success message in json format for the UI
    $status = success_msg('Product successfully removed from the bag', true);

    return $status;

  }

  /**
  * Produces the total cost of all items in a users basket
  *
  * @param Array $products The products in the users basket
  * @param cookie $cookie Contains the quantities of products in the basket
  * @return Number $total The total cost of the users basket
  */
  public function calculateTotal($products, $cookie)
  {
    // incorporate total counting
    $total = 0;

    foreach ($products as $key => $product) {
      $price = ( $products[$key]['attributes']['p_discount_active'] ) ? $products[$key]['attributes']['p_discount_price']
      : $products[$key]['attributes']['p_price'];
      $quantity = $cookie->$products[$key]['attributes']['p_id'];
      $total += $price * $quantity;
    }

    return $total;
  }

  /**
  * Calculate the total number of products in the cart
  *
  * @param Array $cart The products within the cart
  * @return Number $quantity The total number of products in the cart
  */
  public function getCartQuantity($cart)
  {
    $quantity = 0;
    if(count($cart) > 0){

      foreach ($cart as $key => $value) {
        $quantity += $value;
      }
    }

    return $quantity;

  }

  /**
  * Returns a page with the contents of the users cart or if cart is empty,
  * will return a page to indicate so
  *
  * @return \Illuminate\View\View
  */
  public function getCartPage()
  {
    $data['cart'] = json_decode(Cookie::get('cart'));

    if(!$data['cart']){
      $data['products'] = Product::inRandomOrder()->take(4)->get();
      return view('cart.empty_cart', $data);
    }else {

      $ids =  array_keys(get_object_vars($data['cart']));
      $data['products'] = Product::whereIn('p_id', $ids)->get();
      $data['total'] = $this->calculateTotal($data['products'], $data['cart']);

      return view('cart.cart', $data);
    }
  }

}
