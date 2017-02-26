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

    return view('pages.delivery');
  }

  public function getFAQPage()
  {

    return view('pages.faq');
  }

  public function getPaymentPage()
  {

    return view('pages.payment');
  }

  public function getSupportPage()
  {

    return view('pages.support');
  }

  public function getRefundPage()
  {

    return view('pages.refunds');
  }
  public function get404()
  {
    return view('errors.404');
  }
}
