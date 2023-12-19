<?php

namespace App\Http\Services\Upload;

use Illuminate\Support\Facades\Session;

class uploadService
{
    public function store($request)
    {
        if ($request->hasFile('poster')) {
            try {
                $path = $request->file('poster')->store('uploads');
//                $file = $request->file('file');
//                $folder = $request->input('folder');
//                $pre = strtoupper(substr($folder, 0, 1));
//
//                $name = $pre . 'IMG' . date('Ymd') . uniqid() . '.' . $file->getClientOriginalExtension();
//
//                $path_full = 'uploads/' . $folder;
//                $file->storeAs(
//                    'public/' . $path_full, $name
//                );
//
//                return '/storage/' . $path_full . '/' . $name;

            } catch(\Exception $err) {
                Session::flash('error', $err->getMessage());
            }
        }

    }
}
