<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider as Slider;
use Cookie;
use App\Http\Requests\AddSliderRequest;
use App\Http\Requests\UpdateSliderRequest;

class AdminSlidersController extends Controller
{

  public function __construct()
  {
      $this->middleware('admin');
  }


  public function getSliders()
  {
    $data['sliders'] = Slider::all()->toArray();

    return view('admin.sliders.view', $data);
  }

  public function addSlider()
  {
    return view('admin.sliders.add');
  }

  public function editSlider($id)
  {
    $data['slider'] = Slider::where('id', $id)->first();

    return view('admin.sliders.edit', $data);

  }

  public function add(AddSliderRequest $request)
  {

    $inputs = $request->input();
    $slider = new Slider();

    $slider->s_title = $inputs['title'];
    $slider->s_link = $inputs['link'];
    $slider->s_image = " ";

    $slider->save();

    $imageName = $slider->id . '.' . $request->file('image')->getClientOriginalExtension();

    $image = $request->file('image');

    $request->file('image')->move(
        base_path() . '/public/img/slider', $imageName
    );

    $slider->s_image = "/img/slider/" . $imageName;

    $slider->save();

    $status = success_msg('Successfully added a slider');

    return redirect()->route('admin.sliders.get')->with('status', $status );
  }

  public function update(UpdateSliderRequest $request, $id)
  {
    $inputs = $request->input();
    $slider = Slider::where('id', $id)->first();

    $slider->s_title = $inputs['title'];
    $slider->s_link = $inputs['link'];

    $slider->save();

    $image = $request->file('image');

    if($image){
      $imageName = $slider->id . '.' . $request->file('image')->getClientOriginalExtension();

      $request->file('image')->move( base_path() . '/public/img/slider', $imageName );

      $slider->s_image = "/img/slider/" . $imageName;

      $slider->save();
    }

    $status = success_msg('Successfully updated the slider');

    return redirect()->route('admin.sliders.get')->with('status', $status );

  }

  public function delete($id)
  {

    $slider = Slider::where('id', $id)->get()->first();
    $slider->delete();

    $status = success_msg('Successfully deleted the delivery type');

    return $status;

  }

}
