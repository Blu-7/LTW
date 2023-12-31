<?php

namespace App\Http\Services\User;

use App\User;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helper;
class UserService
{
    public function getUser($request)
    {
        ## Lấy user theo email
        $result = User::where('email', $request->input('email'))->first();
        return $result;
    }

    public function getAll()
    {
        ## Query hết user và phân trang theo từng 10 records
        return User::with('role')->orderBy('id')->search()->paginate(10);
    }
}
