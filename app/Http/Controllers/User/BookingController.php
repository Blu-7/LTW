<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Services\User\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    public function booking()
    {
        return view('cinema.user.booking', [
            'title' => 'Hacimi - Chọn ghế'
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
            'title' => 'Hacimi - Thanh toán thành công'
        ]);
    }
}
