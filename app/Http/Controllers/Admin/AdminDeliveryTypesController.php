<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Delivery as Delivery;
use Cookie;

class AdminDeliveryTypesController extends Controller
{

  public function __construct()
  {
      $this->middleware('admin');
  }


  public function getDeliveryTypes()
  {
    $data['deliveries'] = Delivery::all()->toArray();

    return view('admin.delivery_types.view', $data);
  }


}
