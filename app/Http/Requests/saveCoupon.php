<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class saveCoupon extends FormRequest
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
            'coupon_code'=> 'required|unique:coupons',
            'coupon_type'=>'required',
            'coupon_value'=>'required',
            'coupon_status'=> 'required'
        ];
    }
}
