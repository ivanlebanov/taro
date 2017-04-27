<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Product as Product;
use App\Category as Category;
use App\Slider as Slider;
use App\User as User;
use App\Message as Message;
use Cookie;
use App\Http\Requests\UpdateContactUsRequest;

class CompareController extends Controller
{

  /**
  * Retrieves the products to be compared from the users cookies
  *
  * @return \Illuminate\View\View
  */
  public function get()
  {
    $compare_cookie = explode( ', ', Cookie::get('compare') );
    $data['products'] = Product::whereIn('p_id', $compare_cookie)->get();

    return view('compare.show', $data);
  }

  /**
  * Adds a new product to the list to compare
  *
  * @param Request $request The request object
  * @return JSON $response | error_msg | success_msg $status
  */
  public function add(Request $request)
  {
    $inputs = $request->input();
    $compare_cookie = Cookie::get('compare');
    $compare_list = ($compare_cookie != "") ? explode( ', ', $compare_cookie ) : [];
    // check if the product id is already saved in the cookie
    if(in_array($inputs['p_id'], $compare_list)){
      // return user friendly message
      $response = (count($compare_list) == 1) ? error_msg('You have already added this product') :
                  error_msg('You have already added this product. See comparision <a href="' . route('compare.get') . '">here</a>.');

      return response()->json($response);

    }
    if(count($compare_list) > 2)
      return response()->json(error_msg('Maximum items to add are 3.
      Please remove some from<a href="' . route('compare.get') . '"> here</a>.
      If you want to add a new one'));
    // append the new id
    $compare_list[] = $inputs['p_id'];
    $new_length = count($compare_list);
    $new_cookie = ($new_length > 1) ? implode( ', ', $compare_list ) : $inputs['p_id'];
    // save for 60 minutes
    Cookie::queue('compare', $new_cookie, 60000);

    // return the appropriate message to the user

    $status = ($new_length == 1) ? success_msg('Successfully added for comparision. Add at least 2 products to compare') :
      success_msg('Successfully added for comparision. <a href="' . route('compare.get') . '">Check it here</a>.');
    return $status;
  }

  /**
  * Removes a product from comparison list
  *
  * @param Request $request
  * @return success_msg
  */
  public function remove(Request $request)
  {
    $input = $request->input();
    $compare_cookie = Cookie::get('compare');
    $compare_list = ($compare_cookie != "") ? explode( ', ', $compare_cookie ) : [];
    $new_list = array();

    foreach ($compare_list as $key => $item) {
      if($item != $input['p_id'])
        $new_list[] = $item;
    }

    $new_cookie = (count($new_list > 0)) ? implode( ', ', $new_list ) : [];
    // save for 60 minutes
    Cookie::queue('compare', $new_cookie, 60000);

    return success_msg('Successfully removed item');
  }
}
