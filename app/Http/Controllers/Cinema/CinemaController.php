<?php

namespace App\Http\Controllers\Cinema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Cinema\CinemaService;

class CinemaController extends Controller
{
    protected $cinemaService;

    public function __construct(CinemaService $cinemaService)
    {
        $this->cinemaService = $cinemaService;
    }

    public function index(){
        $list = $this->cinemaService->get();
        return view('cinema.slideshow', [
            'title' => 'Trang chủ',
            'list' => $list,
        ]);
    }
}
