<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category as Category;
use App\Http\Requests\AddCategoryRequest;

use Cookie;

class AdminCategoryController extends Controller
{

  public function __construct()
  {
      $this->middleware('admin');
  }


  public function getCategories()
  {
    $data['categories'] = Category::all()->toArray();

    return view('admin.category.view', $data);
  }


  public function addCategory()
  {
    return view('admin.category.add');
  }

  public function editCategory($id)
  {
    $data['category'] = Category::where('pc_id', $id)->first();
    return view('admin.category.edit', $data);
  }

  public function add(AddCategoryRequest $request)
  {
    $inputs = $request->input();
    $category = new Category();
    $category->pc_name = $inputs['pc_name'];

    $category->save();

    $status = success_msg('Successfully added a category');

    return redirect()->route('admin.categories.get')->with('status', $status );

  }
  public function update(AddCategoryRequest $request, $id)
  {
    $inputs = $request->input();
    $category = Category::where('pc_id', $id)->first();
    $category->pc_name = $inputs['pc_name'];

    $category->save();

    $status = success_msg('Successfully updated a category');

    return redirect()->route('admin.categories.get')->with('status', $status );
  }

  public function delete($id)
  {

    $category = Category::where('pc_id', $id)->get()->first();
    $category->delete();

    $status = success_msg('Successfully deleted a category');

    return $status;
  }

}
