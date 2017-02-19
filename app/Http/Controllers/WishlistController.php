<?php

namespace App\Http\Controllers;

use App\Product as Product;
use App\Category as Category;
use App\Slider as Slider;
use App\User as User;
use App\Message as Message;
use Cookie;
use Illuminate\Http\Request;

class WishlistController extends Controller
{

  public function get()
  {
    $wishlist_cookie = explode( ', ', Cookie::get('wishlist') );
    $data['products'] = Product::whereIn('p_id', $wishlist_cookie)->get();

    return view('wishlist.show', $data);
  }

  public function add(Request $request)
  {
    $inputs = $request->input();
    $wishlist_cookie = Cookie::get('wishlist');
    $wishlist_list = ($wishlist_cookie != "") ? explode( ', ', $wishlist_cookie ) : [];
    // check if the product id is already saved in the cookie
    if(in_array($inputs['p_id'], $wishlist_list)){
      // return user friendly message
      $response = error_msg('You have already added this product. Your wishlist is <a href="' . route('wishlist.get') . '">here</a>.');

      return response()->json($response);

    }
    // append the new id
    $wishlist_list[] = $inputs['p_id'];
    $new_length = count($wishlist_list);
    $new_cookie = ($new_length > 1) ? implode( ', ', $wishlist_list ) : $inputs['p_id'];
    // save for 60 minutes
    Cookie::queue('wishlist', $new_cookie, 60000);

    // return the appropriate message to the user

    $status = success_msg('Successfully added to the wishlist. <a href="' . route('wishlist.get') . '">Check it here</a>.');
    return $status;

  }

  public function remove(Request $request)
  {
    $input = $request->input();
    $wishlist_cookie = Cookie::get('wishlist');
    $wishlist_list = ($wishlist_cookie != "") ? explode( ', ', $wishlist_cookie ) : [];
    $new_list = array();

    foreach ($wishlist_list as $key => $item) {
      if($item != $input['p_id'])
        $new_list[] = $item;
    }

    $new_cookie = (count($new_list > 0)) ? implode( ', ', $new_list ) : [];
    // save for 60 minutes
    Cookie::queue('wishlist', $new_cookie, 60000);

    return success_msg('Successfully removed item');
  }

}
