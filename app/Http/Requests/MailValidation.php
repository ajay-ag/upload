<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailValidation extends FormRequest
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

           'mail_host'      => 'required',
           'smtp_port'      => 'required',
           // 'email'          => 'required',
           'smtp_username'  => 'required',
           'smtp_password'  => 'required',
        //    'email_charset'  => 'required',
           // 'bcc_email'      => 'required',
    
        ];
    }

     public function messages()
    {
        return [
           'mail_host.required'     => 'Mail Host is required',
           'smtp_port.required'     => 'Mail Port is required',
           'email.required'         => 'Email is required',
           'smtp_username.required' => 'Mail Username is required',
           'smtp_password.required' => 'Mail Password is required',
        //    'email_charset.required' => 'Email Charset is required',
           // 'bcc_email.required'     => 'BCC Emails is required',
        ];
    }
}
