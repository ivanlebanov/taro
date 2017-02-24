<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product as Product;
use Cookie;

class AdminProductsController extends Controller
{

  public function __construct()
  {
      $this->middleware('admin');
  }


  public function getProducts()
  {
    $data['products'] = Product::all()->toArray();

    return view('admin.products.view', $data);
  }


}
