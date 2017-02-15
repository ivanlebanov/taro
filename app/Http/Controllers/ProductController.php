<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Product as Product;
use App\Category as Category;
use App\User as User;
use App\Company as Company;
use App\Http\Requests\UpdatePersonalInfoRequest;
use App\Http\Requests\UpdateAddressRequest;
class ProductController extends Controller
{
  public function getCategoryPage($category)
  {

    $data['category'] = Category::where('pc_name', $category)->first();
    $category_id = $data['category']['attributes']['pc_id'];
    $data['latest_products'] = Product::where('category_id', $category_id)->orderBy('updated_at', 'desc')->take(4)->get();

    return view('products.category', $data);
  }

  public function getSingleProductPage($id, $category)
  {
    $data['product'] = Product::where('p_id', $id)->first();
    $category_id = $data['product']['attributes']['category_id'];
    $company_id = $data['product']['attributes']['p_company_id'];
    $data['category'] = Category::where('pc_id', $category_id)->first();
    $data['company'] = Company::find($company_id)->first();

    return view('products.single_product', $data);
  }

}
