<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SubcategoryValidation extends FormRequest
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
    public function rules(Request $request)
    {
        // dd($request);
        return [
            
            'category'     => 'required',
            'name'         => 'required',
            'slider_image' => 'sometimes|required|mimes:png,jpg,jpeg|max:5000',

        ];
    }

     public function messages()
    {
        return [

           'category.reqiured'     => 'Category is required',
           'name.required'         => 'Name is required',
           'slider_image.required' => 'Image is required',
    
        ];
    }

}
