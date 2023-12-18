<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\CreateFormRequest;
use Illuminate\Http\Request;
use App\Http\Services\Movie\MovieService;

class MovieController extends Controller
{

    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function create(){
        return view('admin.movies.create', [
            'title' => 'Thêm phim mới'
        ]);
    }

    public function store(CreateFormRequest $request){
//        dd($request->input());
        $result = $this->movieService->create($request);
    }
    public function showAll(){
        echo 456;
    }
}
