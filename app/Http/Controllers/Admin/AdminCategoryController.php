<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category as Category;
use Cookie;

class AdminCategoryController extends Controller
{

  public function __construct()
  {
      $this->middleware('admin');
  }


  public function getCategories()
  {
    $data['categories'] = Category::all()->toArray();

    return view('admin.category.view', $data);
  }


}
