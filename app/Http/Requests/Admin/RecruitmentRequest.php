<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RecruitmentRequest extends FormRequest
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
            "nationality" => "required",
            "age" => "required",
            "certificates" => "required",
            "experience" => "required",
            "area" => "required",
            "city" => "required",
            "phone" => "required",
            "message" => "nullable",
        ];
    }
}
