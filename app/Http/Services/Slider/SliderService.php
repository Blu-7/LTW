<?php

namespace App\Http\Services\Slider;

use App\Models\Slider;
use App\Http\Services\Upload\uploadService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SliderService
{
    protected $uploadService;
    public function __construct(uploadService $uploadService){
        $this->uploadService = $uploadService;
    }
    public function create($request){
        try {
            Slider::create([
                'name' => (string) $request->input('name'),
                'poster' => (string) $request->input('poster'),
                'deleted' => 0,
            ]);
            Session::flash('success', 'Thêm slider mới thành công');
        }catch (\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function get()
    {
        $slider = DB::select("SELECT * FROM sliders WHERE deleted = 0 ORDER BY created_at DESC");
        return $slider;
    }

    public function destroy($request){
        $id = $request->input('id');
        $movie = Slider::where('id', $id)->first();
        $time = Carbon::now();
        if($movie){
            return DB::update("UPDATE sliders SET deleted = 1, updated_at = '$time' WHERE id = '$id'");
        }
        return false;
    }

    public function update($movie, $request){
        try {
            $movie->fill($request->input());
            $movie->save();
            return true;
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

}
