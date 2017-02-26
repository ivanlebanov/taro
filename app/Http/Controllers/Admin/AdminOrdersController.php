<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order as Order;
use App\User as User;
use App\Http\Requests\AddCategoryRequest;
use Cookie;

class AdminOrdersController extends Controller
{

  public function __construct()
  {
      $this->middleware('admin');
  }


  public function getOrders()
  {
    $data['orders'] = Order::all()->toArray();

    foreach ($data['orders'] as $key => $order) {
      $user = User::where('id', $order['o_user_id'])->first()->toArray();
      $data['orders'][$key]['user'] = $user;
    }

    return view('admin.orders.view', $data);
  }



  public function editOrder($id)
  {
    $order = Order::where('id', $id)->first();

    foreach ($order['attributes'] as $order_keys => $order_values)
      $data['order'][$order_keys] = json_decode($order_values, true);
      
    return view('admin.orders.edit', $data);
  }



  public function delete($id)
  {

    $category = Order::where('id', $id)->get()->first();
    $category->delete();

    $status = success_msg('Successfully deleted an order');

    return $status;
  }

}
