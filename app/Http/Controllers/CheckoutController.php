<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product as Product;
use App\Delivery as Delivery;
use App\Order as Order;
use App\User as User;
use App\Http\Controllers\CartController as CartController;
use Cookie;

class CheckoutController extends Controller
{

  /**
  * Create a new controller instance
  *
  * @return void
  */
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
  * Displays the checkout page including the users data and and Delivery options
  *
  * @return \Illuminate\View\View
  */
  public function getCheckoutPage()
  {
    $user = \Auth::user()['attributes'];
    $data['delivery_types'] = Delivery::all();
    $data['user'] = array_only($user, ['name', 'telephone', 'address', 'town_city', 'country', 'postcode']);
    $data['delivery_type_id'] = $user['delivery_type_id'];

    return view('checkout.page', $data);
  }

  /**
  * Places an order and then adjusts the stock levels of purchased products in the database.
  *
  * @param Request $request The request object from the user
  * @return \Illuminate\Support\Facades\Redirect
  */
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

    $this->reacalculateStock($cart, true);

    // creating a new order
    $order = new Order;

    $order->o_products = json_encode($products);
    $order->o_total = $total;
    $order->o_delivery = json_encode($delivery);
    $order->o_address = json_encode($user_info);
    $order->o_user_id = $user_id;
    $order->o_hidden = $this->generateRandomString();
    $order->o_products_quantities = json_encode($cart);
    $order->save();

    $this->createReceipt($user_id, $delivery, $user_info, $products, $cart, $total, $order);

    Cookie::queue('cart', null, 60000);

    // success message in json format for the UI
    $status = success_msg('The order has been made');

    return redirect()->route('checkout.confirmed', ['id' => $order->id])->with('status', $status );

  }

  /**
  *
  */
  public function createReceipt($user_id, $delivery, $user_info, $products, $cart, $total, $order)
  {

    $user = User::where('id', $user_id)->first()->toArray();
    $html = '<h1>Your order #' . $order->id . "</h1>";
    $html .= "<p>Thanks for shopping at TARO. This is a proof of your order.</p>";

    $products_html = "";
    $products_html .= "<ul>";

    foreach ($products as $key => $product) {
      $products_html .= "<li>";
      $products_html .= $cart->$product['p_id'] . "x" . $product['p_name'] . " - ";
      $products_html .= ($product['p_discount_active'] == 1) ? "£" . $product['p_price'] . "</strike> £" . $product['p_discount_price']
      : "£" .$product['p_price'] ;

      $products_html .= "</li>";
    }

    $products_html .= "</ul>";
    $html .= $products_html;
    $html .= "Those product(s) will be delivered to " . $user['address'] . ", " . $user['town_city'] .
    ", " . $user['country'] . " for " . $user['name'] . ".";
    $html .= "<h3>Total: £" . $total . "</h3>";
    $pdf = \PDF::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false)->save('orders/order' . $order->o_hidden . '.pdf');

    //$this->sendMail($order, $html);

  }

  /**
  * Sends an email with provided content to the email within an order
  *
  * @param Array $order
  * @param String $content
  */
  public function sendMail($order, $content)
  {

    \Mail::send('emails.send', ['content' => $content], function ($message)
    {

        $message->from('test@myport.ac.uk', 'TARO team');

        $message->to('test@myport.ac.uk');

        //Add a subject
        $message->subject("Your order");

    });
  }

  /**
  * Provides access to the receipt for an order, to the user who placed it
  *
  * @param Int $id The orders id
  * @return \Illuminate\Support\Facades\Redirect
  */
  public function getReceipt($id)
  {
    $data['order'] = Order::where('id', $id)->first()['attributes'];
    if($data['order']['o_user_id'] != \Auth::user()['attributes']['id'])
      return redirect()->back()->with('status', error_msg('Not allowed to see that page') );

    return "/orders/order" . $data['order']['o_hidden'] . ".pdf";
  }

  /**
  * Redirects the user to a confirmation page when an order is placed successfully
  *
  * @param Int $id The id of the order
  * @return \Illuminate\View\View
  */
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

  /**
  * Adjusts the stock levels of products in the database
  *
  * @param Array $cart The products in the cart
  * @param bool $bought Whether the cart was purchased or not
  */
  public function reacalculateStock($cart, $bought)
  {

    foreach ($cart as $id => $quantity) {
      $product = Product::where('p_id', $id)->first();
      if($product){
        $p_stock = ($bought === true) ? $product->p_stock - $quantity : $product->p_stock + $quantity;
        $p_sales = ($bought === true) ? $product->p_sales + $quantity : $product->p_sales - $quantity;
        $product->update(array('p_stock' => $p_stock, 'p_sales' => $p_sales));
      }

    }

  }

  /**
  * Allows the cancellation of orders that have been placed within the last hour by the user that placed it
  *
  * @param Int $id the order id
  * @return success_msg | error_msg Provides either a succes or error message
  */
  public function declineOrder($id)
  {
    $order = Order::where('id', $id)->get()->first();
    if($order['attributes']['o_user_id'] != \Auth::user()['attributes']['id'])
      return error_msg('Not allowed to do this');
    if(strtotime($order['created_at']) < strtotime("-60 minutes"))
      return error_msg('An hour has passed');

    $this->reacalculateStock(json_decode($order['attributes']['o_products_quantities']), false);

    $order->delete();

    return success_msg('The order has been declined');

  }

  /**
  * Generates a randomised string
  *
  * @param Int $length An integer which is defined as 10
  * @return String $randomString The produced random string
  */
  public function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
}
