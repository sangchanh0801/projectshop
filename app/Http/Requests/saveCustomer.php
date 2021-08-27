<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class saveCustomer extends FormRequest
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
            'customer_fname' => 'required|max:120',
            'customer_lname' => 'required|max:120',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|min:11|numeric',
            'customer_password' => 'required',



        ];
    }
}
