<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class InstallRequest extends FormRequest
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
            "name" => "required",
            "phone" => "required",
            "email" => "required",
            "area_id" => "required",
            "city_id" => "required",
            "product_id"=>"required",
            "neighborhood" => "required",
            "street" => "required",
            "date" => "required",
            // "products_number" => "required",
            "quantity" => "required",
            "order_number" => "required",
            "message" => "nullable",
        ];
    }
}
