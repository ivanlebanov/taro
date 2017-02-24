<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider as Slider;
use Cookie;

class AdminSlidersController extends Controller
{

  public function __construct()
  {
      $this->middleware('admin');
  }


  public function getSliders()
  {
    $data['sliders'] = Slider::all()->toArray();

    return view('admin.sliders.view', $data);
  }


}
