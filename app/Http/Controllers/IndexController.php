<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product as Product;
class IndexController extends Controller
{
  /**
  *  Method for displaying the homepage.
  **/
  public function index()
  {
    // get latest 4 products currently being promoted
    $active_promotions = Product::where('p_discount_active', 1)->orderBy('updated_at', 'desc')->take(4)->get();

    return view('welcome', ["products" => $active_promotions]);
  }

}
