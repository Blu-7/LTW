<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\User\Controller;

class MainController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'title' => 'Trang chủ',
        ]);
    }
}
