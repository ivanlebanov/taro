<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User as User;
use Cookie;

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


}
