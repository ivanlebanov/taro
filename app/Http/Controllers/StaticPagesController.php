<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Product as Product;
use App\Category as Category;
use App\Slider as Slider;
use App\User as User;
use App\Http\Requests\UpdatePersonalInfoRequest;
use App\Http\Requests\UpdateAddressRequest;
class StaticPagesController extends Controller
{
  public function getDeliveryPage()
  {
    # code...
    return view('pages.delivery');
  }

  public function getFAQPage()
  {
    # code...
    return view('pages.faq');
  }

  public function getPaymentPage()
  {
    # code...
    return view('pages.payment');
  }

  public function getSupportPage()
  {
    # code...
    return view('pages.support');
  }

  public function getRefundPage()
  {
    # code...
    return view('pages.refunds');
  }
}
