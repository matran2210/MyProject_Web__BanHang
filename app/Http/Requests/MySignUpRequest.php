<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MySignUpRequest extends FormRequest
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
            'email' => 'bail|required|email|',
            'password' => 'bail|required|min:3'
        ];
    }
    public function messages()
    {
        return [

            'password.required' => 'Password không được để trống',

            'email.required' => 'Email không được để trống',


            'email.email' => 'Email không đúng định dạng',

            'password.min' => 'Mật khẩu tối thiểu 3 kí tự',

        ];
    }
}
