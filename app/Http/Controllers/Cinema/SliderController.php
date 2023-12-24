<?php

namespace App\Http\Controllers\Cinema;

use App\Http\Requests\Slider\CreateFormRequest;
use App\Http\Services\Slider\SliderService;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    protected $sliderService;

    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliders.create', [
            'title' => 'Thêm Slider phim mới'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFormRequest $request)
    {
        $result = $this->sliderService->create($request);

        if($result){
            Session::flash('success', 'Tạo mới slider thành công');
            return redirect('admin/sliders/all');
        }
        else {
            Session::flash('error', 'Tạo mới slider thất bại');
            return false;
        }
    }

    public function showAll(){
        return view('admin.sliders.all', [
            'title' => 'Danh sách Slider',
            'menu' => 'Slider',
            'list' => $this->sliderService->get()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        return view('admin.sliders.edit', [
            'title' => 'Chỉnh sửa: ' . $slider->name,
            'item'  => $slider->name,
            'menu'  => 'Danh sách Slider',
            'slider' => $slider
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(CreateFormRequest $request, Slider $slider)
    {
        $result = $this->sliderService->update($slider, $request);
        if($result) {
            Session::flash('success', 'Cập nhật Slider thành công');
//            return redirect('admin/movies/all');
            return redirect()->route('sliders.all');
        }
        else {
            Session::flash('error', 'Cập nhật slider thất bại');
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result = $this->sliderService->destroy($request);
        if($result){
            return response()->json([
                'success' => true,
                'msg' => 'Xóa thành công'
            ]);
        }

        return response()->json([
            'success' => false,
            'msg' => 'Không xóa được, vui lòng thử lại'
        ]);
    }
}
