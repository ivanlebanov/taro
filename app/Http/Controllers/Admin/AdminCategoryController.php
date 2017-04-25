<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category as Category;
use App\Http\Requests\AddCategoryRequest;
use Cookie;

class AdminCategoryController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Admin Category Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles CRUD related to categories for
  | the products in the shop.
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
   * A page listing all categories.
   *
   * @return \Illuminate\View\View
   */
  public function getCategories()
  {
    $data['categories'] = Category::all()->toArray();

    return view('admin.category.view', $data);
  }

  /**
   * A page used for adding a category.
   *
   * @return \Illuminate\View\View
   */
  public function addCategory()
  {
    return view('admin.category.add');
  }

  /**
   * A page used to display a category which
   * afterwards can be edited.
   *
   * @param int $id unique identifier of the category
   * @return \Illuminate\View\View
   */
  public function editCategory($id)
  {
    $data['category'] = Category::where('pc_id', $id)->first();

    return view('admin.category.edit', $data);

  }
  /**
   * A method used for adding a category.
   *
   * @param array $request the validated form data
   * @return \Illuminate\Support\Facades\Redirect redirects main admin category page
   * with a success/error message
   */
  public function add(AddCategoryRequest $request)
  {
    $inputs = $request->input();
    $category = new Category();
    $category->pc_name = $inputs['pc_name'];

    $category->save();

    $status = success_msg('Successfully added a category');

    return redirect()->route('admin.categories.get')->with('status', $status );

  }

  /**
   * A method used for updating a category.
   *
   * @param array $request the validated form data
   * @param int $id unique identifier of the category which is about to be updated
   * @return \Illuminate\Support\Facades\Redirect redirects main admin category page
   * with a success/error message
   */
  public function update(AddCategoryRequest $request, $id)
  {
    $inputs = $request->input();
    $category = Category::where('pc_id', $id)->first();
    $category->pc_name = $inputs['pc_name'];

    $category->save();

    $status = success_msg('Successfully updated a category');

    return redirect()->route('admin.categories.get')->with('status', $status );
  }

  /**
   * A method used for deleting a category.
   *
   * @param int $id unique identifier of the category which is about to be deleted
   * @return string $status error/success message
   */
  public function delete($id)
  {

    $category = Category::where('pc_id', $id)->get()->first();
    $category->delete();

    $status = success_msg('Successfully deleted a category');

    return $status;
  }

}
