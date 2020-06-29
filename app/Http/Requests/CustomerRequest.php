<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
           'name' => 'required',
           'email'=>'required',
           'gender'=>'required',
           'address'=>'required',
           'phone'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=> 'Vui lòng nhập tên của bạn',
            'gender.required'=> 'Vui lòng nhập giới tính của bạn',
            'email.required'=> 'Vui lòng nhập email của bạn',
            'phone.required'=> 'Vui lòng nhập số điện thoại của bạn',
            'address.required'=> 'Vui lòng nhập địa chỉ của bạn'
        ];
    }
}
