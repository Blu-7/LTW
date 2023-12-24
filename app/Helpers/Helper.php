<?php

namespace App\Helpers;

use Illuminate\Support\Facades\URL;

class Helper
{

    public static function listSlider($list){
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

    public static function active($active): string
    {
        return $active == 1 ? '<span class="badge badge-pill badge-success">Hiển thị</span>'
            : '<span class="badge badge-pill badge-secondary">Ẩn</span>';
    }

    public static function makeAvatar($fontPath, $dest, $char) {
        $path = $dest;
        $image = imagecreate(200,200);
        $red = rand(0,255);
        $green = rand(0,255);
        $blue = rand(0,255);
        imagecolorallocate($image, $red, $green, $blue);
        $textcolor = imagecolorallocate($image,255,255,255);
        imagettftext($image,100,0,55,150,$textcolor,$fontPath,$char);
        imagepng($image, $path);
        imagedestroy($image);
        return '/' . $path;
    }
}
