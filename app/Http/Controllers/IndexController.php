<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product as Product;
use App\Category as Category;
use App\Slider as Slider;
class IndexController extends Controller
{
  /**
  *  Method for displaying the homepage.
  **/
  public function index()
  {
    // get latest 4 products currently being promoted
    $data = array();
    $data['slider'] = Slider::orderBy('updated_at', 'desc')->take(4)->get();
    $data['on_sale'] = Product::where('p_discount_active', 1)->orderBy('updated_at', 'desc')->take(4)->get();
    $data['best_sellers'] = Product::orderBy('p_sales', 'desc')->take(4)->get();

    return view('welcome', $data);
  }

  /**
  *  Method for displaying the homepage.
  * will be soon @deprecated and refactored
  **/
  public function productPage()
  {
    // get latest 4 products currently being promoted
    $categories = Category::all();

    $active_promotions = Product::where('p_discount_active', 1)->orderBy('updated_at', 'desc')->take(4)->get();

    foreach ($active_promotions as $productkey => $product) {
      $active_promotions[$productkey]['category'] = Category::where('pc_id', $product['product_category_id'])->get()[0]['pc_name'];
    }


    return view('products.products', ["products" => $active_promotions, 'categories' => $categories]);
  }
}
