<?php

namespace App\Http\Controllers\User;

class IntroController extends Controller
{
    public function intro()
    {
        return view('cinema.user.intro', [
            'title' => 'Giới thiệu',
        ]);
    }

    public function contact()
    {
        return view('cinema.template.footer', [
            'title' => 'Liên hệ',
        ]);
    }
}
