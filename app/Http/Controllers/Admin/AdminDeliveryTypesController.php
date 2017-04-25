<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Delivery as Delivery;
use Cookie;
use App\Http\Requests\AddDeliveryRequest;


class AdminDeliveryTypesController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Admin Delivery Types Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles CRUD related to Delivery Types for
  | the orders in the shop.
  |
  */

  /**
   * Create a new controller instance. Uses admin
   * middleware to protect the data.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('admin');
  }

  /**
   * A page listing all delivery types.
   *
   * @return \Illuminate\View\View
   */
  public function getDeliveryTypes()
  {
    $data['deliveries'] = Delivery::all()->toArray();

    return view('admin.delivery_types.view', $data);
  }

  /**
   * A page used to display a delivery type which
   * afterwards can be edited.
   *
   * @param int $id unique identifier of the delivery type
   * @return \Illuminate\View\View
   */
  public function editDeliveryTypes($id)
  {
    $data['delivery'] = Delivery::where('id', $id)->first();

    return view('admin.delivery_types.edit', $data);
  }

  /**
   * A page used for adding a delivery type.
   *
   * @return \Illuminate\View\View
   */
  public function addDeliveryTypes()
  {
    return view('admin.delivery_types.add');
  }

  /**
   * A method used for adding a delivery type.
   *
   * @param array $request the validated form data
   * @return \Illuminate\Support\Facades\Redirect redirects main admin delivery type page
   * with a success/error message
   */
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

  /**
   * A method used for updating a delivery type.
   *
   * @param array $request the validated form data
   * @param int $id unique identifier of the delivery type which is about to be updated
   * @return \Illuminate\Support\Facades\Redirect redirects main admin delivery type page
   * with a success/error message
   */
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

  /**
   * A method used for deleting a delivery type.
   *
   * @param int $id unique identifier of the delivery type which is about to be deleted
   * @return string $status error/success message
   */
  public function delete($id)
  {

    $delivery = Delivery::where('id', $id)->get()->first();
    $delivery->delete();

    $status = success_msg('Successfully deleted the delivery type');

    return $status;
  }

}
