<?php

namespace App\Http\Controllers\User;

class FilmController extends Controller
{
    public function film()
    {
        return view('cinema.user.film', [
            'title' => 'Phim',
        ]);
    }
}
