<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Delivery as Delivery;
use Cookie;
use App\Http\Requests\AddDeliveryRequest;


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

  public function editDeliveryTypes($id)
  {
    $data['delivery'] = Delivery::where('id', $id)->first();

    return view('admin.delivery_types.edit', $data);
  }

  public function addDeliveryTypes()
  {

    return view('admin.delivery_types.add');
  }

  public function add(AddDeliveryRequest $request)
  {
    $inputs = $request->input();
    $delivery = new Delivery();

    $delivery->dt_name = $inputs['name'];
    $delivery->dt_price = $inputs['price'];
    $delivery->dt_length = $inputs['length'];

    $delivery->save();

    $status = success_msg('Successfully add a delivery type');

    return redirect()->route('admin.delivery_types.get')->with('status', $status );
  }

  public function update(AddDeliveryRequest $request, $id)
  {
    $inputs = $request->input();
    $delivery = Delivery::where('id', $id)->first();

    $delivery->dt_name = $inputs['name'];
    $delivery->dt_price = $inputs['price'];
    $delivery->dt_length = $inputs['length'];

    $delivery->save();

    $status = success_msg('Successfully updated a delivery type');

    return redirect()->route('admin.delivery_types.get')->with('status', $status );
  }

  public function delete($id)
  {

    $delivery = Delivery::where('id', $id)->get()->first();
    $delivery->delete();

    $status = success_msg('Successfully deleted the delivery type');

    return $status;
  }

}
