<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Product as Product;
use App\Category as Category;
use App\Slider as Slider;
use App\User as User;
use App\Http\Requests\UpdatePersonalInfoRequest;
use App\Http\Requests\UpdateAddressRequest;
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

  public function savePersonalInfo(UpdatePersonalInfoRequest $request)
  {
    // get the keys needed from the form
    $data = array_only($request->input(), ['name', 'telephone']);
    // GET user to update
    $user = User::find(\Auth::user()['attributes']['id'])->first();
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
    $user = User::find(\Auth::user()['attributes']['id'])->first();
    // update all fields
    foreach ($data as $key => $value)
      $user->$key = $value;

    // save the new data
    $user->save();
    // success message in json format for the UI
    $status = success_msg('Successfully updated address');

    return redirect()->back()->with('status', $status );

  }

}
