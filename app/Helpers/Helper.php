<?php

namespace App\Helpers;

use Illuminate\Support\Facades\URL;

class Helper
{

    public static function listSlider($list){
        ## Trả về các list slideshow ở trang admin
        $html = '';
        $index = 0;
        foreach ($list as $key => $val) {
            $index += 1;
            $html .= '
                <tr id="' . $val->id . '" name="item">
                    <td>
                        <input type="checkbox" id="item_checkbox" name="item_checkbox" data-id="' . $val->id . '">
                    </td>
                    <td>' . $index . '.</td>
                    <td>' . $val->name . '</td>
                    <td class="text-center"><img src="' . $val->poster . '" width="100%" height="auto"></td>
                    <td class="text-center">
                        <a class="btn btn-info btn-sm" href="/admin/sliders/edit/' . $val->id . '">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="#"
                            onClick="removeRow(' . $val->id . ', \'/admin/sliders/destroy\', \'categories-table\')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            ';
        }
        return $html;
    }
    public static function list($list)
    {
        ## Trả về các list poster hình ảnh ở trang admin
        $html = '';
        $index = 0;
        foreach ($list as $key => $val) {
            $index += 1;
            $html .= '
                <tr id="' . $val->id . '" name="item">
                    <td>
                        <input type="checkbox" id="item_checkbox" name="item_checkbox" data-id="' . $val->id . '">
                    </td>
                    <td>' . $index . '.</td>
                    <td>' . $val->name . '</td>
                    <td>' . $val->description . '</td>
                    <td class="text-center"><img src="' . $val->poster . '" width="100%" height="auto"></td>
                    <td class="text-center">
                        <a class="btn btn-info btn-sm" href="/admin/movies/edit/' . $val->id . '">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="#"
                            onClick="removeRow(' . $val->id . ', \'/admin/movies/destroy\', \'categories-table\')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            ';
        }
        return $html;
    }
}
