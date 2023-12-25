<?php

namespace App\Http\Controllers\User;

use App\Http\Services\Cinema\CinemaService;
use App\Movie;

class FilmController extends Controller
{
    protected $cinemaService;

    public function __construct(CinemaService $cinemaService)
    {
        $this->cinemaService = $cinemaService;
    }

    public function movie()
    {
        return view('cinema.user.movie', [
            'title' => 'Phim',
            'movies' => $this->cinemaService->getMovies(),
        ]);
    }

    public function detailMovie(Movie $movie){
        return view('cinema.user.detail', [
            'title' => 'Khám phá',
            'movie' => $movie,
        ]);
    }
}
