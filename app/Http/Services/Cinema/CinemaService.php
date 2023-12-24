<?php

namespace App\Http\Services\Cinema;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class CinemaService
{
    public function get()
    {
        $movies = DB::select("SELECT * FROM movies WHERE deleted = 0 ORDER BY created_at DESC");
        return $movies;
    }

}
