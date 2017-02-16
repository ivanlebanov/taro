<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Product as Product;
use App\Category as Category;
use App\Slider as Slider;
use App\User as User;
use App\Message as Message;
use Cookie;
use App\Http\Requests\UpdateContactUsRequest;

class CartController extends Controller
{
  public function add(Request $request, $id)
  {
    // success message in json format for the UI
    $status = success_msg('Product successfully added to the bag');
    
    return $status;

  }
}
