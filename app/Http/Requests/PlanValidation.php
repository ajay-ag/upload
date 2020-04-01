<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;    
use Illuminate\Foundation\Http\FormRequest;

class PlanValidation extends FormRequest
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
        $id = $this->get('id');
        return [
            'title' => 'required',
            'title' => 'required|unique:plans,title,'.$id,
            'feature' => 'required',
            'price' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Plan name is required!',
            'title.unique' => 'Plan name already been taken',
            'feature.required' => 'Feature is required',
            'price.required' => 'Price is required!',
        ];
    }
}
