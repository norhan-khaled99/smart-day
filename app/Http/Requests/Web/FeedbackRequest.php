<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
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
            'point1' => 'required|integer|min:1|max:5',
            'point2' => 'required|integer|min:1|max:5',
            'point3' => 'required|integer|min:1|max:5',
            'point4' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:255',
            //'code'=>"nullable",
        ];
    }
}
