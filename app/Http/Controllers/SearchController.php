<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Product as Product;
use App\Category as Category;
use App\Slider as Slider;
use App\User as User;
use App\Http\Requests\UpdatePersonalInfoRequest;
use App\Http\Requests\UpdateAddressRequest;
class SearchController extends Controller
{

  public function search(Request $request)
  {
    $input = $request->input();
    $search = '%'.$input['phrase'].'%';
    $data['phrase'] = $input['phrase'];
    $data['products'] = Product::where('p_id', 'LIKE', $search)->orwhere('p_name', 'LIKE', $search)->get()->toArray();

    return view('products.search', $data);
  }

  public function searchResults(Request $request)
  {
    $input = $request->input();
    $search = '%'.$input['phrase'].'%';
    $data['phrase'] = $input['phrase'];
    $data['products'] = Product::where('p_name', 'LIKE', $search)->take(5)->get()->toArray();

    foreach ($data['products'] as $key => $product) {
      $data['products'][$key]['url'] = route('products.single_product', ['id' => $product['p_id'], 'name' => str_slug($product['p_name']) ]);
    }

    return response()->json($data['products']);
  }
}
