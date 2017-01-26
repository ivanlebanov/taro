<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product as Product;
class IndexController extends Controller
{

  public function index()
  {
    # code..
    //dd('test');
    $products = array();
    $products = Product::all();
    $products = Product::where('p_discount_active', 1)->get();
    $products = Product::where('p_discount_active', 1)->orderBy('p_name')->get();
    //dd($products);

    return view('welcome', ["products" => $products]);
  }

}
