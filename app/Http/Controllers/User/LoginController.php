<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('user.login', [
            'title' => 'Đăng nhập hệ thống'
        ]);
    }
    public function validateLogin(Request $request){
        $remember = $request->input('remember') ? true : false;
        $this->validate($request, [
           'name' => 'required',
           'password' => 'required',
        ]);

        if(Auth::attempt([
            'name' => $request->input('name'),
            'password' => $request->input('password')
        ], $remember)){
            return route('/');
        };
    }
}
