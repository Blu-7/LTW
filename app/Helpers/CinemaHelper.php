<?php

namespace App\Helpers;

use Illuminate\Support\Facades\URL;

class CinemaHelper
{

    ## Trả về list các html slideshow
    public static function slideshow($slides){
        $html = '';
        foreach($slides as $key => $value){
            $html .= '<img src="'. $value->poster .'" width="100%" alt="">';
        }
        return $html;
    }
}
