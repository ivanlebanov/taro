<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User as User;
use App\Delivery as Delivery;
use Cookie;
use App\Http\Requests\AdminEditUserRequest;

class AdminUsersController extends Controller
{

  public function __construct()
  {
      $this->middleware('admin');
  }


  public function getUsers()
  {
    $data['users'] = User::all()->toArray();

    return view('admin.users.view', $data);
  }

  public function editUser($id)
  {
    $data['user'] = User::where('id', $id)->first()->toArray();
    $data['delivery_type_id'] = $data['user']['delivery_type_id'];
    $data['delivery_types'] = Delivery::all()->toArray();

    return view('admin.users.edit', $data);
  }

  public function update(AdminEditUserRequest $request, $id)
  {
    $inputs = $request->input();
    $user = User::where('id', $id)->first();
    $user->name = $inputs['name'];
    $user->email = $inputs['email'];
    $user->telephone = $inputs['telephone'];
    $user->address = $inputs['address'];
    $user->address = $inputs['address'];
    $user->town_city = $inputs['town_city'];
    $user->country = $inputs['country'];
    $user->postcode = $inputs['postcode'];
    $user->delivery_type_id = $inputs['delivery_type_id'];
    $user->save();

    $status = success_msg('Successfully updated a user');

    return redirect()->route('admin.users.get')->with('status', $status );
  }

  public function delete($id)
  {
    $user = User::where('id', $id)->get()->first();
    $user->delete();

    $status = success_msg('Successfully deleted the user');

    return $status;

  }
}
