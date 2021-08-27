<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class saveProduct extends FormRequest
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
            'product_name' => 'required|max:150',
            'product_slug' => 'required',
            'product_price' => 'required',
            'product_desc' => 'required',
            'product_content' => 'required',
            'product_image' => 'string|required',
            'product_number' => 'required|digits_between:1,5',
            'product_cost'=> 'required',
        ];
    }
}
