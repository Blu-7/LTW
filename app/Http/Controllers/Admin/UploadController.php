<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\Upload\uploadService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    protected $uploadService;

    public function __construct(uploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }
    public function store(Request $request){
        dd($request->all());
        $this->uploadService->store($request);

    }
}
