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
            ## Tạo mới một record booking khi chọn ghế
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
}
