<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\Customer\SignInRequest;
use App\Http\Requests\Customer\SignUpRequest;
use App\Http\Services\User\UserService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('cinema.user.login', [
            'title' => 'Hacimi - Đăng nhập'
        ]);
    }

    public function signup(){
        return view('cinema.user.signup', [
            'title' => 'Hacimi - Đăng ký'
        ]);
    }

    public function validateLogin(SignInRequest $request){
        $remember = $request->input('remember') ? true : false;
        if(Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ], $remember)){
            $result = $this->userService->getUser($request);
            Session::put('user', $result);
            return redirect()->route('welcome');
        };
        Session::flash('error', 'Sai email hoặc mật khẩu');
        return redirect()->back();
    }

    public function validateSignup(SignUpRequest $request){
        try{
            $user = new User();
            $user->name = $request->input('name');
            $user->password = bcrypt($request->input('password'));
            $user->email = $request->input('email');
            $user->is_admin = 0;
            $user->save();
            Session::flash('success', 'Đăng ký thành công');
        }
        catch (\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;
        };
        return redirect()->back();
    }

    public function signout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
