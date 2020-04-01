<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralsettingValidation extends FormRequest
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

           'store_name'   => 'required',
           'account_email'=> 'required',
           'contact_us'   => 'required',
           'legal_name'   => 'required',
           'phone'        => 'required',
           'address1'     => 'required',
           'country'      => 'required',
           'state'        => 'required',
           'city_id'      => 'required',
           'postal_code'  => 'required',
    
        ];
    }

    public function messages()
    {
        return [

           'store_name.required'    => 'Store name is required',
           'account_email.required' => 'Email is required',
           'contact_us.required'    => 'Contact isrequired',
           'legal_name.required'    => 'Legal name is required',
           'phone.required'         => 'Phone number is required',
           'address1.required'      => 'Address is required',
           'country.required'       => 'Country is required',
           'state.required'         => 'State is required',
           'city_id.required'       => 'City is required',
           'postal_code.required'   => 'Postal code is required',

        ];
    }
}
