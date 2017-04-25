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
  /*
  |--------------------------------------------------------------------------
  | Admin Sliders Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles CRUD related to the slider
  | situated on the home page.
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
   * A page listing all slides.
   *
   * @return \Illuminate\View\View
   */
  public function getSliders()
  {
    $data['sliders'] = Slider::all()->toArray();

    return view('admin.sliders.view', $data);
  }

  /**
   * A page used for adding a slider.
   *
   * @return \Illuminate\View\View
   */
  public function addSlider()
  {
    return view('admin.sliders.add');
  }

  /**
   * A page used to display a slider which
   * afterwards can be edited.
   *
   * @param int $id unique identifier of the slider
   * @return \Illuminate\View\View
   */
  public function editSlider($id)
  {
    $data['slider'] = Slider::where('id', $id)->first();

    return view('admin.sliders.edit', $data);

  }

  /**
   * A method used for adding a slider.
   *
   * @param array $request the validated form data
   * @return \Illuminate\Support\Facades\Redirect redirects main admin slider page
   * with a success/error message
   */
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

  /**
   * A method used for updating a slider.
   *
   * @param array $request the validated form data
   * @param int $id unique identifier of the slider which is about to be updated
   * @return \Illuminate\Support\Facades\Redirect redirects main admin slider page
   * with a success/error message
   */
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

  /**
   * A method used for deleting a slider.
   *
   * @param int $id unique identifier of the slider which is about to be deleted
   * @return string $status error/success message
   */
  public function delete($id)
  {

    $slider = Slider::where('id', $id)->get()->first();
    $slider->delete();

    $status = success_msg('Successfully deleted the delivery type');

    return $status;

  }

}
