<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product as Product;
use Cookie;

class CartController extends Controller
{

  public function add(Request $request, $id)
  {
    $cart = json_decode(Cookie::get('cart'));
    $cartData = array();

    if(!$cart){
      $cartData[$id] = 1;
      $cartData = json_encode($cartData);
    }else{

      if( property_exists($cart, $id) )
        $cart->$id = $cart->$id + 1;
      else
        $cart->$id = 1;

      $cartData = json_encode($cart);
    }

    Cookie::queue('cart', $cartData, 60000);

    // success message in json format for the UI
    $status = success_msg('Product successfully added to the bag');

    return $status;

  }

  public function getCartPage()
  {
    $data['cart'] = json_decode(Cookie::get('cart'));
    if(!$data['cart']){
      $data['products'] = Product::inRandomOrder()->take(4)->get();
      return view('cart.empty_cart', $data);
    }else {

      $ids =  array_keys(get_object_vars($data['cart']));
      $data['total'] = 0;
      $data['products'] = Product::whereIn('p_id', $ids)->get();

      // incorporate total counting
      foreach ($data['products'] as $key => $product) {
        $price = ( $data['products'][$key]['attributes']['p_discount_active'] ) ? $data['products'][$key]['attributes']['p_discount_price']
        : $data['products'][$key]['attributes']['p_price'];
        $data['total'] += $price * $data['cart']->$data['products'][$key]['attributes']['p_id'];
      }
      //dd($total);
      return view('cart.cart', $data);
    }
  }

}
