@extends('cinema.template.main')
@section('header')
    <link type="text/css" rel="stylesheet" href="/assets/css/detail-phim.css">
@endsection
@section('content')
{{--Màn hình hiển thị chi tiết của một phim--}}
    <div class="content-gallery-explore" id="beauty">
        <div class="content" id="loadPlaces">
                <div class="each-content content-{{$movie->id}}">
                    <div class="content-image">
                        <div class="image"><img src="{{$movie->poster}}" alt=""></div>
                    </div>
                    <div class="card-body" style="padding:1rem;">
                        <div class="row">
                            <div class="col-10">
                                <div class="content-info">
                                    <h5 class="m-4"><i class=""></i>{{$movie->name}}</h5>
                                </div>
                            </div>
                            <div class="col-10">
                                <div class="content-info">
                                    <h6 class="m-4"><i class=""></i>{{$movie->description}}</h6>
                                </div>
                            </div>
                            <div class="" align="center">
                                <input type="hidden" value="{{$movie->id}}" class="place-id">

                            </div>
                        </div>

                        <div class="detail row justify-content-center align-items-center">
                            <a href="/booking/{{$movie->slug}}" target="_blank">
                                <button type="button" class="button-81" role="button">Đặt vé</button>
                            </a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection


