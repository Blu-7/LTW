<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'email' => 'required|email:filter',
            'password' => 'min:6|required|same:confirm_password',
            'confirm_password' => 'min:6|required',
        ];
    }

    public function messages() : array
    {
        return [
            'name.required'         => 'Vui lòng nhập tên',
            'email.required'         => 'Vui lòng nhập địa chỉ email',
            'email.email:filter' => 'Vui lòng nhập đúng cú pháp email',
            'password.min:6' => 'Vui lòng nhập mật khẩu dài hơn 6 kí tự',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'confirm_password.min:6' => 'Xác minh mật khẩu phải hơn 6 kí tự',
            'confirm_password.required' => 'Vui lòng xác minh mật khẩu',
            'password.same:confirm_password' => 'Mật khẩu không trùng khớp',
        ];
    }
}
