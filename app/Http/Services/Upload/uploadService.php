<?php

namespace App\Http\Services\Upload;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class uploadService
{
    public function store($request)
    {
        $filename = '';
        if ($request->hasFile('upload')) {
            try {
                $filename = $request->file('upload')->store('public/uploads');
                $filename = str_replace('public', '/storage', $filename);
                return $filename;

            } catch(\Exception $err) {
                Session::flash('error', $err->getMessage());
                return false;
            }
        }

    }

    public function destroy($request)
    {
        try {
            $path = str_replace('/storage', 'public', $request->input('val'));
//            Storage::delete($path);
            return true;
        } catch (\Exception $err){
            return false;
        }

    }
}
