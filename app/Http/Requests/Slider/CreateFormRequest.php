<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
            'upload' => 'mimes:jpeg,png,jpg|max:2048',
            'poster' => 'required'
        ];
    }

    public function messages() : array
    {
        return [
            'name.required'         => 'Vui lòng nhập tên slider',
            'poster.required'       => 'Vui lòng chọn slider',
            'upload.mimes:jpeg,png,jpg' => 'Vui lòng chọn đúng định dạng hình ảnh',
            'upload.max:2048' => 'Hình ảnh vượt quá dung lượng cho phép (Tối đa 2MB)',
        ];
    }
}
