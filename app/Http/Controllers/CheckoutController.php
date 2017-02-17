<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product as Product;
use App\Delivery as Delivery;
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

    return view('checkout.page', $data);
  }

}
