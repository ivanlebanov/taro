<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product as Product;
use Cookie;

class CartController extends Controller
{
  
  public function add(Request $request, $id)
  {
    // success message in json format for the UI
    $status = success_msg('Product successfully added to the bag');

    return $status;

  }
}
