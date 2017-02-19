<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product as Product;
use App\Category as Category;
use App\Company as Company;
use App\ProductImage as ProductImage;

class ProductController extends Controller
{
  /**
  * Show a category page.
  *
  * @param  string  $category - the name of the category
  * @return View
  */
  public function getCategoryPage($category)
  {
    // current category
    $data['category'] = Category::where('pc_name', $category)->first();
    $category_id = $data['category']['attributes']['pc_id'];
    // latest product for initial page load
    $data['latest_products'] = Product::where('category_id', $category_id)->orderBy('updated_at', 'desc')->take(4)->get();

    return view('products.category', $data);
  }

  /**
  * Show a single product page.
  *
  * @param  int  $id - unique identifier for the product
  * @param  int  $name - the name of the product /used for pretty links/
  * @return View
  */
  public function getSingleProductPage($id, $name)
  {
    // the data from the product table
    $data['product'] = Product::where('p_id', $id)->first();
    $category_id = $data['product']['attributes']['category_id'];
    $company_id = $data['product']['attributes']['p_company_id'];
    // product's category
    $data['category'] = Category::where('pc_id', $category_id)->first();
    // product's company
    $data['company'] = Company::where('id', $company_id)->first();
    $data['gallery'] = ProductImage::where('pi_product_id', $id)->get()->all();

	  $data['relatedproducts'] = Product::where('category_id', $category_id)->where('p_id', '!=', $id)->inRandomOrder()->take(4)->get();

    return view('products.single_product', $data);
  }

  public function getSingleProduct($id)
  {
    $product = Product::where('p_id', $id)->first();

    return json_encode($product);
  }

}
