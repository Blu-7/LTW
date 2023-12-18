<?php

namespace App\Http\Controllers\Admin\User;
use App\Http\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(){
        return view('admin.users.login', [
            'title' => 'Đăng nhập hệ thống'
        ]);
    }
    public function validateLogin(Request $request){
        $remember = $request->input('remember') ? true : false;
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'id' => 1
        ], $remember)){
            return redirect()->route('admin');
        }
//        Session::flush();
        Session::flash('error', 'Email or password not match');
        return redirect()->back();
    }
}
