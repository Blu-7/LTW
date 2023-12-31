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
    ## Controller trả về trang đăng nhập
    public function index(){
        return view('admin.users.login', [
            'title' => 'Đăng nhập hệ thống'
        ]);
    }
    ## Controller xử lý dữ liệu khi login
    public function validateLogin(Request $request){
        $remember = $request->input('remember') ? true : false;
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required',
        ]);
        ## Chỉ cho phép record user có id = 1
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'id' => 1
        ], $remember)){
            $result = $this->userService->getUser($request);
            ## Tạo một session cho admin
            Session::put('admin', $result);
            return redirect()->route('admin');
        }
        ## Trả về lỗi
        Session::flash('error', 'Email or password not match');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        ## Hủy session khi logout
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
