@extends('cinema.template.main')
@section('header')
{{--    @include('cinema.template.navbar_custom')--}}
    @include('cinema.slider.header')
@endsection
@section('content')
    <style>
        .slideshow-body {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .slide-show {
            width: 100%;
            overflow: hidden;
            position: relative;
        }
        .list-images {
            display: flex;
            transition: 0.5s;
        }
        .btn:hover {
            color: white;
        }
        .btn {
            font-size: 45px;
            color: #999;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            transition: 0.5s;
            cursor: pointer;
        }
        .btn-left {
            left: 0;
        }
        .btn-right {
            right: 0;
        }
        .index-images {
            position: absolute;
            bottom: 10px;
            display: flex;
            left: 50%;
            transform: translateX(-50%);
        }
        .index-item {
            border: 2px solid #999;
            padding: 10px;
            margin: 3px;
            border-radius: 50%;
        }
        .active {
            background-color: #999;
        }
    </style>
    <div class="slide-show slideshow-body">
        <div class="list-images">
            {!! \App\Helpers\CinemaHelper::slideshow($list) !!}
{{--            <img src="https://images3.alphacoders.com/106/1069102.jpg" width="100%" alt="">--}}
{{--            <img src="https://i.pinimg.com/originals/71/9e/80/719e80760999b4c355a723224120eb07.png" width="100%" alt="">--}}
{{--            <img src="https://images5.alphacoders.com/112/thumb-1920-1123013.jpg" width="100%" alt="">--}}
        </div>
        <div class="btns">
            <div class="btn-left btn"><i class='bx bx-chevron-left'></i></div>
            <div class="btn-right btn"><i class='bx bx-chevron-right'></i></div>
        </div>
        <div class="index-images">
            <div class="index-item index-item-0 active"></div>
            <div class="index-item index-item-1"></div>
            <div class="index-item index-item-2"></div>
        </div>
    </div>

@endsection
@section('footer')
    @include('cinema.slider.footer')
@endsection
