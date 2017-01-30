<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product as Product;
use App\Category as Category;
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

  /**
  *  Method for displaying the homepage.
  **/
  public function productPage()
  {
    // get latest 4 products currently being promoted
    $categories = Category::all();

    $active_promotions = Product::where('p_discount_active', 1)->orderBy('updated_at', 'desc')->take(4)->get();
    //dd($active_promotions);
    foreach ($active_promotions as $productkey => $product) {
      $active_promotions[$productkey]['category'] = Category::where('pc_id', $product['product_category_id'])->get()[0]['pc_name'];
    }


    return view('products.products', ["products" => $active_promotions, 'categories' => $categories]);
  }
}
