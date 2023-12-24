<?php

namespace App\Helpers;

use Illuminate\Support\Facades\URL;

class CinemaHelper
{
    public static function slideshow($slides){
        $html = '';
        foreach($slides as $key => $value){
            $html .= '<img src="'. $value->poster .'" width="100%" alt="">';
        }
        return $html;
    }
}
