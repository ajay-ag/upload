<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingValidation extends FormRequest
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

           'shipping_amount'     => 'sometimes|required',
           'shipping_percentage' => 'sometimes|required',
           'address_line1'       => 'required',
           'country'             => 'required',
           'state'               => 'required',    
           'city_id'             => 'required',
           'postal_code'         => 'required',
           'phone'               => 'required',


        ];
    }

    public function messages()
    {
        return [

           'shipping_amount.required'     => 'Shipping Amount is required',
           'shipping_percentage.required' => 'Shipping Percentage is required',
           'address_line1.required'       => 'Address is required',
           'country.required'             => 'Country is required',
           'state.required'               => 'State is required',
           'city_id.required'             => 'City is required',
           'postal_code.required'         => 'Postal Code is required',
           'phone.required'               => 'Phone is required',
    
        ];
    }
}
