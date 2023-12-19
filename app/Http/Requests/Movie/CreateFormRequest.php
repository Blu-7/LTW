<?php

namespace App\Http\Requests\Movie;

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
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'poster' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages() : array
    {
        return [
            'name.required'         => 'Vui lòng nhập tên phim',
            'poster.required'       => 'Vui lòng chọn poster của phim',
            'description.required'  => 'Vui lòng nhập mô tả phim',
            'start_date.required'   => 'Vui lòng chọn ngày khởi chiếu',
            'start_date.date'       => 'Vui lòng chọn đúng định dạng của ngày khởi chiếu',
            'end_date.required'     => 'Vui lòng chọn ngày kết thúc',
            'end_date.date'         => 'Vui lòng chọn đúng định dạng của ngày kết thúc',
            'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu',
            'poster.mimes:jpeg,png,jpg,gif' => 'Vui lòng chọn đúng định dạng hình ảnh',

        ];
    }
}
