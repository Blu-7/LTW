<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
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
            'email' => 'required|email:filter',
            'password' => 'min:6|required|',
        ];
    }

    public function messages() : array
    {
        return [
            'email.required'         => 'Vui lòng nhập địa chỉ email',
            'email.email:filter' => 'Vui lòng nhập đúng cú pháp email',
            'password.min:6' => 'Vui lòng nhập mật khẩu dài hơn 6 kí tự',
            'password.required' => 'Vui lòng nhập mật khẩu',
        ];
    }
}
