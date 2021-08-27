<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class savebanner extends FormRequest
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
            'banner_name'=> 'required',
            'banner_slug' => 'required',
            'banner_image'=> 'required|image',
            'banner_desc' => 'required',
            'banner_status'=>'required',
        ];
    }
}
