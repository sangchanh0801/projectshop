<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class saveCheckout extends FormRequest
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
            'shipping_fname' => 'required',
            'shipping_lname' => 'required',
            'shipping_email' => 'required|email',
            'shipping_phone' => 'required|max:10',
            'shipping_address' => 'required',



        ];
    }
}
