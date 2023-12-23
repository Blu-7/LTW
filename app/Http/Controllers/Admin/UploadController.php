<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\User\Controller;
use App\Http\Services\Upload\uploadService;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    protected $uploadService;

    public function __construct(uploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }
    public function store(Request $request)
    {
        $result = $this->uploadService->store($request);

        if ($result != false) {
            return response()->json([
                'success' => true,
                'url' => $result,
                'msg' => 'Upload hình ảnh thành công'
            ]);
        }
        return response()->json([
            'success' => false,
            'msg' => 'Không upload được hình ảnh'
        ]);
    }

    public function destroy(Request $request)
    {
        $result = $this->uploadService->destroy($request);
        if ($result) {
            return response()->json([
                'success' => true,
            ]);
        }
        return response()->json([
            'success' => false
        ]);
    }
}
