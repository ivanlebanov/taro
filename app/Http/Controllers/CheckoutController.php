<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product as Product;
use App\Delivery as Delivery;
use App\Order as Order;
use App\Http\Controllers\CartController as CartController;
use Cookie;

class CheckoutController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getCheckoutPage()
  {
    $user = \Auth::user()['attributes'];
    $data['delivery_types'] = Delivery::all();
    $data['user'] = array_only($user, ['name', 'telephone', 'address', 'town_city', 'country', 'postcode']);
    $data['delivery_type_id'] = $user['delivery_type_id'];

    return view('checkout.page', $data);
  }

  public function placeOrder(Request $request)
  {
    $user = \Auth::user()['attributes'];
    $user_id = $user['id'];
    $user_info = array_only($user, ['name', 'telephone', 'address', 'town_city', 'country', 'postcode']);

    // validation if the user has field all the fields
    foreach ($user_info as $key => $field) {
      if($field == "")
        return redirect()->back()->with('status', error_msg('Ensure you have added your personal info and address') );
    }

    // validation if the user has chosen a delivery method
    if($user['delivery_type_id'] == "")
      return redirect()->back()->with('status', error_msg('Ensure you have added method of delivery') );

    // validation for empty cookie
    if(Cookie::get('cart') == null )
      return redirect()->back()->with('status', error_msg('Ensure you have products in the bag') );

    // getting the data
    $cart = json_decode(Cookie::get('cart'));
    $ids =  array_keys(get_object_vars($cart));
    $products = Product::whereIn('p_id', $ids)->get();
    $delivery = Delivery::where('id', $user['delivery_type_id'])->first()['attributes'];
    $total = (new CartController)->calculateTotal($products, $cart) + $delivery['dt_price'];

    // creating a new order
    $order = new Order;

    $order->o_products = json_encode($products);
    $order->o_total = $total;
    $order->o_delivery = json_encode($delivery);
    $order->o_address = json_encode($user_info);
    $order->o_user_id = $user_id;
    $order->o_products_quantities = json_encode($cart);
    $order->save();

    Cookie::queue('cart', null, 60000);

    // success message in json format for the UI
    $status = success_msg('The order has been made');

    return redirect()->route('checkout.confirmed', ['id' => $order->id])->with('status', $status );

  }

  public function orderConfirmed($id)
  {

    $data['order'] = Order::where('id', $id)->first()['attributes'];
    if($data['order']['o_user_id'] != \Auth::user()['attributes']['id'])
      return redirect()->back()->with('status', error_msg('Not allowed to see that page') );
    foreach ($data['order'] as $key => $value) {
      $data['order'][$key] = json_decode($value, true);
    }

    return view('checkout.order_placed', $data);
  }
}
