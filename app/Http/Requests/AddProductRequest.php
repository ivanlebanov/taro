<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Response;

class AddProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          "name"   => "required|Min:3",
          "price"   => "required|Numeric",
          "discount_price"  => "Numeric",
          "discount_active" => "required|Min:0|Max:1|Integer",
          "sales"   => "required|Min:0|Integer",
          "stock"   => "required|Min:0",
          "user_manual_link"   => "mimes:pdf",
          "thumb"   => "required|image",
          "category"   => "required",
          "company"   => "required",
        ];
    }
}
