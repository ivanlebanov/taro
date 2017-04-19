<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as User;
use App\Order as Order;
use App\Http\Requests\UpdatePersonalInfoRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Http\Requests\UpdateUserAccountRequest;
use App\Http\Requests\UpdateUserDeliveryRequest;

class UserController extends Controller
{
/**
 * Create a new controller instance.
 *
 * @return void
 */
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function profile()
  {
      $user = \Auth::user();
      $data['personal'] = array_only($user['attributes'], ['name', 'telephone']);
      $data['location'] = array_only($user['attributes'], ['address', 'town_city', 'country', 'postcode']);

      return view('user.profile', $data);

  }

  public function orders()
  {
    $user = \Auth::user();
    $orders = Order::where('o_user_id', $user->id )->get()->all();

    if(count($orders) > 0)
      foreach ($orders as $key => $order)
        foreach ($order['attributes'] as $order_keys => $order_values)
          $data['orders'][$key][$order_keys] = ($order_keys != "created_at") ? json_decode($order_values, true) : $order_values;
    else
      $data['orders'] = [];

    return view('user.orders', $data);

  }
  public function savePersonalInfo(UpdatePersonalInfoRequest $request)
  {
    // get the keys needed from the form
    $data = array_only($request->input(), ['name', 'telephone']);
    // GET user to update
    $user = User::where('id', \Auth::user()['attributes']['id'])->first();
    // update all fields
    foreach ($data as $key => $value)
      $user->$key = $value;

    // save the new data
    $user->save();
    // success message in json format for the UI
    $status = success_msg('Successfully updated personal info');

    return redirect()->back()->with('status', $status );

  }

  public function saveAddress(UpdateAddressRequest $request)
  {
    // get the keys needed from the form
    $data = array_only($request->input(), ["address","town_city", "country", "postcode"]);
    // GET user to update
    $user = User::where('id', \Auth::user()['attributes']['id'])->first();
    // update all fields
    foreach ($data as $key => $value)
      $user->$key = $value;

    // save the new data
    $user->save();
    // success message in json format for the UI
    $status = success_msg('Successfully updated address');

    return redirect()->back()->with('status', $status );

  }

  public function update(UpdateUserAccountRequest $request)
  {
    // get the keys needed from the form
    $data = array_only($request->input(), ['name', 'telephone', "address","town_city", "country", "postcode"]);
    // GET user to update
    $user = User::where('id', \Auth::user()['attributes']['id'])->first();
    // update all fields
    foreach ($data as $key => $value)
      $user->$key = $value;

    // save the new data
    $user->save();
    // success message in json format for the UI
    $status = success_msg('Successfully updated user information');

    return redirect()->back()->with('status', $status );
  }

  public function addDelivery(UpdateUserDeliveryRequest $request)
  {
    $input = $request->input();
    $user = User::where('id', \Auth::user()['attributes']['id'])->first();
    $user->delivery_type_id = $input['delivery_type'];

    // save the new data
    $user->save();
    // success message in json format for the UI
    $status = success_msg('Successfully updated preffered delivery type');

    return redirect()->back()->with('status', $status );
  }
}
