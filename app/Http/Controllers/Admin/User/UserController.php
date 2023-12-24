<?php

namespace App\Http\Controllers\Admin\User;
use App\Http\Controllers\User\Controller;
use App\Http\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
            $result = $this->userService->getUser($request);
            Session::put('user', $result);
            return redirect()->route('admin');
        }
        Session::flash('error', 'Email or password not match');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
