<?php

namespace App\Http\Controllers;
use App\Product as Product;
use App\Category as Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
