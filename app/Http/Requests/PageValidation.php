<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageValidation extends FormRequest
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

           'title'           => 'required',
           'content'         => 'required',
           'url_handle'      => 'required',
    
        ];
    }

    public function messages()
    {
        return [

           'title.required'        => 'Title is required',
           'content.required'      => 'Content is required',
           'url_handle.required'   => 'Url Handle is required',

        ];
    }
}
