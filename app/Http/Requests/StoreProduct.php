<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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

            'title'         => 'required',
            //'slider_image' => 'sometimes|required|mimes:png,jpg,jpeg|max:5000',
            'content'       => 'required',
            'category'      => 'required',
            'sub_category'  => 'required',

        ];
    }
    public function messages()
    {
        return [

           'title.required'         => 'Product title is required',
           //'slider_image.required' => 'Image is required',
           'title.content'          => 'Content is required',
           'title.category'         => 'Please select category',
           'title.sub_category'     => 'Please select sub category',
    
        ];
    }
}
