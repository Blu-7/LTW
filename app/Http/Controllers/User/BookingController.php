<?php

namespace App\Http\Controllers\User;

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
        $data = array();
        if(Session::has('data'))
            $data = Session::get('data');
        return view('cinema.user.done', [
            'title' => 'Hacimi - Thanh toán thành công',
            'data' => $data
        ]);
    }

    public function forward(Request $request){
        $data = $request->all();
        $title = 'Test';
//        dd($request->all());
//        dd($request['money']);
        Session::flash('data', $data);
//        $view = view('cinema.user.done', compact('title'))->render();
        $returnHtml = view('cinema.user.done')->with('title', $title)->render();
        return response()->json(array('success' => true, 'html'=> $returnHtml));
//        return view('cinema.user.done', [
//            'title' => 'Done',
//            'data' => $data
//        ]);
//        Session::flash('data', $data);
//        return Redirect::action('App\Http\Controllers\Controller\BookingController@done');
//        return redirect()->route('done',  $data);
    }
}
