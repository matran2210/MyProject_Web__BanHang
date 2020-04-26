<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyRequest_Info_Customer extends FormRequest
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
            'email' => 'bail|required|email',
            //chú ý nếu ta thêm điều kiện cho 1 name mà bên view kia ko có cái name đó thì sẽ lỗi khó phát hiện
            //nó cứ redirect->back() liên tục mà không hiện lỗi lên cho ta biết
            //ns chung có ô input nào thì mới đặt điều kiện cho ô input đó, k đặt thừa
            'fullname' => 'bail|required',
            'address' => 'bail|required',
            'phone'  =>'bail|required'
        ];
    }
    public function messages()
    {
        return [


            'fullname.required' => 'Họ và tên không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'email.required' => 'Email không được để trống',

            'email.email' => 'Email không đúng định dạng',

        ];
    }
}
