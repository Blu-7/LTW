<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\CreateFormRequest;
use Illuminate\Http\Request;
use App\Http\Services\Movie\MovieService;
use App\Movie;
use Illuminate\Support\Facades\Session;

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
        $filename = '';
        if($request->hasFile('poster')){
            $filename = $request->file('poster')->store('uploads');
        }

        $result = $this->movieService->create($request, $filename);

        if($result){
            Session::flash('success', 'Tạo mới phim thành công');
            return redirect()->back();
        }
        else {
            Session::flash('error', 'Tạo mới phim thất bại');
            return false;
        }
    }
    public function showAll(){
        echo 456;
    }
}
