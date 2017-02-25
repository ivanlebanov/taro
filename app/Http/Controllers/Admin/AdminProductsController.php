<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Company as Company;
use App\Category as Category;
use App\Product as Product;
use App\ProductImage as ProductImage;
use Cookie;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;

class AdminProductsController extends Controller
{

  public function __construct()
  {
      $this->middleware('admin');
  }


  public function getProducts()
  {
    $data['products'] = Product::all()->toArray();

    return view('admin.products.view', $data);
  }

  public function addProduct()
  {
    $data['product'] = null;
    $companies = Company::all()->toArray();
    $categories = Category::all()->toArray();

    if(count($categories) > 0)
      foreach ($categories as $key => $category)
        $data['categories'][$category['pc_id']] = $category['pc_name'];
    else
      $data['categories'] = [];


    if(count($companies) > 0)
      foreach ($companies as $key => $company)
        $data['companies'][$company['id']] = $company['c_name'];
    else
      $data['companies'] = [];

    return view('admin.products.add', $data);
  }

  public function add(AddProductRequest $request)
  {
    $inputs = $request->input();
    if($inputs["discount_price"] == ""){
      $inputs["discount_price"] = 0;
    }
    $product = new Product();
    $product->p_name = $inputs['name'];
    $product->p_price =  $inputs["price"];
    $product->p_discount_price =  $inputs["discount_price"];
    $product->p_discount_active =  $inputs["discount_active"];
    $product->p_description =  $inputs["description"];
    $product->p_features =  $inputs["features"];
    $product->p_sales =  $inputs["sales"];
    $product->p_stock =  $inputs["stock"];
    $product->category_id =  $inputs["category"];
    $product->p_company_id =  $inputs["company"];
    $product->p_thumb = "";
    $product->p_user_manual_link = "";
    $product->save();

    // saving the thumbnail
    $imageName = $product->p_id . '.' . $request->file('thumb')->getClientOriginalExtension();
    $request->file('thumb')->move( base_path() . '/public/img/products', $imageName );
    $product->p_thumb = "/img/products/" . $imageName;

    //saving user manual if presented
    $manual_file = $request->file('user_manual_link');

    if($manual_file != null){

      $imageName = $product->p_id . '.' . $request->file('user_manual_link')->getClientOriginalExtension();
      $request->file('user_manual_link')->move( base_path() . '/public/manuals', $imageName );
      $product->p_user_manual_link = "/manuals/" . $imageName;

    }

    $product->save();


    // save additional images
    $files = $request->file('additional_images');

    if($request->hasFile('additional_images'))
    {
        foreach ($files as $key => $file) {

            $new_image = new ProductImage();
            $new_image->pi_product_id = $product->p_id;
            $imageName = $key . '.' . $file->getClientOriginalExtension();
            $file->move( base_path() . '/public/img/products/additional/' . $product->p_id, $imageName );
            $new_image->pi_image = "/img/products/additional/" . $product->p_id . "/" . $imageName;
            $new_image->save();
        }
    }



    $status = success_msg('Successfully added a product');

    return redirect()->route('admin.products.get')->with('status', $status );
  }
  public function editProduct($id)
  {
    $data['product'] = Product::where('p_id', $id)->first();
    $data['more_images'] = ProductImage::where('pi_product_id', $id)->get()->all();
    $companies = Company::all()->toArray();
    $categories = Category::all()->toArray();

    if(count($categories) > 0)
      foreach ($categories as $key => $category)
        $data['categories'][$category['pc_id']] = $category['pc_name'];
    else
      $data['categories'] = [];


    if(count($companies) > 0)
      foreach ($companies as $key => $company)
        $data['companies'][$company['id']] = $company['c_name'];
    else
      $data['companies'] = [];

    return view('admin.products.edit', $data);
  }

  public function update(UpdateProductRequest $request, $id)
  {

    $inputs = $request->input();
    if($inputs["discount_price"] == ""){
      $inputs["discount_price"] = 0;
    }
    $product = Product::where('p_id', $id)->first();
    $product->p_name = $inputs['name'];
    $product->p_price =  $inputs["price"];
    $product->p_discount_price =  $inputs["discount_price"];
    $product->p_discount_active =  $inputs["discount_active"];
    $product->p_description =  $inputs["description"];
    $product->p_features =  $inputs["features"];
    $product->p_sales =  $inputs["sales"];
    $product->p_stock =  $inputs["stock"];
    $product->category_id =  $inputs["category"];
    $product->p_company_id =  $inputs["company"];
    $product->save();

    // saving the thumbnail
    $thumb = $request->file('thumb');
    if($thumb){
      $imageName = $product->p_id . '.' . $request->file('thumb')->getClientOriginalExtension();
      $request->file('thumb')->move( base_path() . '/public/img/products', $imageName );
      $product->p_thumb = "/img/products/" . $imageName;
    }
    //saving user manual if presented
    $manual_file = $request->file('user_manual_link');

    if($manual_file != null){

      $imageName = $product->p_id . '.' . $request->file('user_manual_link')->getClientOriginalExtension();
      $request->file('user_manual_link')->move( base_path() . '/public/manuals', $imageName );
      $product->p_user_manual_link = "/manuals/" . $imageName;

    }

    $product->save();


    // save additional images
    $files = $request->file('additional_images');

    if($request->hasFile('additional_images'))
    {
        $images_now = count(ProductImage::where('pi_product_id', $id)->get()->all());

        foreach ($files as $key => $file) {

            $new_image = new ProductImage();
            $new_image->pi_product_id = $product->p_id;
            $id = $images_now + $key;
            $imageName = $id . '.' . $file->getClientOriginalExtension();
            $file->move( base_path() . '/public/img/products/additional/' . $product->p_id, $imageName );
            $new_image->pi_image = "/img/products/additional/" . $product->p_id . "/" . $imageName;
            $new_image->save();
        }
    }



    $status = success_msg('Successfully updated the product');

    return redirect()->route('admin.products.get')->with('status', $status );

  }

  public function deleteImage($id)
  {

    $product_image = ProductImage::where('id', $id)->first();
    $product_image->delete();

    $status = success_msg('Successfully deleted the additional image');

    return $status;
  }

  public function delete($id)
  {

    $product = Product::where('p_id', $id)->first();
    $images = ProductImage::where('pi_product_id', $id)->get()->all();
    foreach ($images as $key => $image) {
      $image->delete();
    }
    $product->delete();

    $status = success_msg('Successfully deleted the product');

    return $status;
  }

}
