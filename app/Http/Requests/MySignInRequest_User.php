<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MySignInRequest_User extends FormRequest
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
            //unique:users,email có nghĩa là giá trị duy nhất trong bảng users, cột là email
            'email' => 'bail|required|email|unique:users,email',
            'password' => 'bail|required|min:3',
            're_password' => 'bail|required|same:password',
            'fullname' => 'bail|required',
            'address' => 'bail|required',
            'phone'  =>'bail|required'
        ];
    }
    public function messages()
    {
        return [

            'password.required' => 'Password không được để trống',
            'fullname.required' => 'Họ và tên không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email này đã có người sử dụng',

            'email.email' => 'Email không đúng định dạng',

            'password.min' => 'Mật khẩu tối thiểu 3 kí tự',

            're-password.same' => 'Nhập lại mật khẩu không chính xác',
        ];
    }
}
