<?php

namespace App\Http\Services\Movie;

use App\Models\Show;
use App\Movie;
use App\Http\Services\Upload\uploadService;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MovieService
{
    protected $uploadService;
    public function __construct(uploadService $uploadService){
        $this->uploadService = $uploadService;
    }
    public function create($request){
        try {
            Movie::create([
               'name' => (string) $request->input('name'),
               'description' => (string) $request->input('description'),
               'start_date' =>  $request->input('start_date'),
               'poster' => (string) $request->input('poster'),
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
//        try {
//            $begin = $request->input('start_date');
//            $end = $request->input('end_date');
//            $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
//            foreach($daterange as $date){
//                foreach($request->showtime as $time)
//                Show::create([
//                    'name' => (string)$request->input('name'),
//                    'date' => $date,
//                    'time' => $time,
//                    'status' => 'Active',
//                    'deleted' => 0,
//                    'movie_id' => $request
//                ]);
//            }
//        }catch (\Exception $err){
//            Session::flash('error', $err->getMessage());
//            return false;
//        }
        return true;
    }

    public function get()
    {
        $movies = DB::select("SELECT * FROM movies WHERE deleted = 0 ORDER BY created_at DESC");
        return $movies;
    }

    public function destroy($request){
        $id = $request->input('id');
        $movie = Movie::where('id', $id)->first();
        $time = Carbon::now();
        if($movie){
            return DB::update("UPDATE movies SET deleted = 1, updated_at = '$time' WHERE id = '$id'");
        }
        return false;
    }

    public function update($movie, $request){
        try {
            $movie->fill($request->input());
            $movie->save();
            return true;
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

}
