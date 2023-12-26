<?php

namespace App\Http\Controllers\User;

use App\Http\Services\User\BookingService;
use App\Movie;
use App\User;
use App\Http\Services\User\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }


    public function booking(Movie $movie)
    {
        return view('cinema.user.booking', [
            'title' => 'Hacimi - Chọn ghế',
            'movie' => $movie
        ]);
    }
    public function tickets()
    {
        return view('cinema.user.tickets', [
            'title' => 'Hacimi - Đặt vé'
        ]);
    }
    public function done()
    {
        return view('cinema.user.done', [
            'title' => 'Hacimi - Thanh toán thành công',
        ]);
    }

    public function forward(Request $request){
        $result = $this->bookingService->create($request);
        if($result){
            return true;
        }
        return false;
    }
    public function payment()
    {
        return view('cinema.user.payment', [
            'title' => 'Hacimi - Thanh toán'
        ]);
    }
}
