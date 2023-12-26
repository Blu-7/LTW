<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\User\Controller;
use App\Http\Requests\Movie\CreateFormRequest;
use App\Http\Services\Movie\MovieService;
use App\Movie;
use Illuminate\Http\Request;
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
        $result = $this->movieService->create($request);

        if($result){
            Session::flash('success', 'Tạo mới phim thành công');
            return redirect('admin/movies/all');
        }
        else {
            Session::flash('error', 'Tạo mới phim thất bại');
            return false;
        }
    }
    public function showAll(){
        return view('admin.movies.show_all', [
            'title' => 'Danh sách phim',
            'menu' => 'Phim',
            'list' => $this->movieService->get()
        ]);
    }

    public function edit(){

    }

    public function update(Movie $movie, CreateFormRequest $request){
        $result = $this->movieService->update($movie, $request);
        if($result) {
            Session::flash('success', 'Cập nhật phim thành công');
//            return redirect('admin/movies/all');
            return redirect()->route('all');
        }
        else {
            Session::flash('error', 'Cập nhật phim thất bại');
            return false;
        }
    }

    public function show(Movie $movie){
        return view('admin.movies.edit', [
            'title' => 'Chỉnh sửa: ' . $movie->name,
            'item'  => $movie->name,
            'menu'  => 'Danh sách phim',
            'movie' => $movie
        ]);
    }

    public function destroy(Request $request){
        $result = $this->movieService->destroy($request);
        if($result){
            return response()->json([
                'success' => true,
                'msg' => 'Xóa thành công'
            ]);
        }

        return response()->json([
            'success' => false,
            'msg' => 'Không xóa được, vui lòng thử lại'
        ]);
    }

}
