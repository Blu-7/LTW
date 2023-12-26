<?php

namespace App\Http\Services\User;

use App\Models\Booking;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helper;
use Carbon\Carbon;
class BookingService
{
    public function create($request){
        try {
            foreach($request['seat'] as $key => $val) {
                Booking::create([
                    'status' => 'Pending',
                    'date' => Carbon::now(),
                    'seat' => $val,
                    'deleted' => 0,
                    'user_id' => $request['user_id'],
                    'show_id' => $request['movie_id'],
                    'payment_id' => null
                ]);
            }
        }catch (\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;
        }
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
