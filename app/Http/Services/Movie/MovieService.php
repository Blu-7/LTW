<?php

namespace App\Http\Services\Movie;

use App\Movie;
use App\Http\Services\Upload\uploadService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MovieService
{
    protected $uploadService;
    public function __construct(uploadService $uploadService){
        $this->uploadService = $uploadService;
    }
    public function create($request, $filename){
        try {
            Movie::create([
               'name' => (string) $request->input('name'),
               'description' => (string) $request->input('description'),
               'start_date' =>  $request->input('start_date'),
               'poster' => (string) $filename,
               'status' => null,
               'end_date' =>  $request->input('end_date'),
               'slug' => Str::slug($request->input('name'), '-'),
               'deleted' => 0,
            ]);

            Session::flash('success', 'Thêm phim mới thành công');
        }catch (\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;

        }
        return true;
    }

}
