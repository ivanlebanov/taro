<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product as Product;
use Cookie;

class CartController extends Controller
{

  public function add(Request $request, $id)
  {
    $inputs = $request->input();
    if(!isset($inputs['quantity']))
      $inputs['quantity'] = 1;
    $cart = json_decode(Cookie::get('cart'));
    $cartData = array();
    // validation if the product is in stock
    $product = Product::where('p_id', $id)->first();

    if($product['p_stock'] == "" || $product['p_stock'] < $inputs['quantity']){
      return error_msg('There is not enough stock');
    }else{
      $product->p_id = $id;

      $p_stock = $product->p_stock - $inputs['quantity'];
      $p_sales = $product->p_sales + $inputs['quantity'];
      $product->update(array('p_stock' => $p_stock, 'p_sales' => $p_sales));
    }

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

    Cookie::queue('cart', $cartData, 60000);

    // success message in json format for the UI
    $status = success_msg('Product successfully added to the bag');

    return $status;

  }

  public function delete(Request $request, $id)
  {
    $cart = json_decode(Cookie::get('cart'));
    $cartData = array();

    foreach ($cart as $product_id => $quantity) {
      if($product_id !== $id)
        $cartData[$product_id] = $quantity;
    }

    $cartData = json_encode($cartData);
    Cookie::queue('cart', $cartData, 60000);


    // success message in json format for the UI
    $status = success_msg('Product successfully removed from the bag', true);

    return $status;

  }
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
