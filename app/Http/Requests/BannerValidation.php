<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerValidation extends FormRequest
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

           //'title'        => 'required',
           //'slider_image' => 'sometimes|required|mimes:png,jpg,jpeg|max:5000',

        ];
    }

    public function messages()
    {
        return [

           //'title.required'        => 'Title is required',
           //'slider_image.required' => 'Image is required',

        ];
    }
}
