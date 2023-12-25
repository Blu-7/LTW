@extends('cinema.template.main')

@section('header')
    <link type="text/css" rel="stylesheet" href="/assets/css/phim.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
@endsection
@section('content')
<div class="content-gallery-explore" id="beauty">
    <div class="content" id="loadPlaces">
    @foreach($movies as $key => $movie)
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
                <div class="col-2" align="center">
                    <input type="hidden" value="{{$movie->id}}" class="place-id">

                </div>
            </div>

            <div class="detail row justify-content-center align-items-center">
                <a href="/movie/detail/{{$movie->id}}" target="_blank">
                    <button type="button" class="button-81" role="button">Chi tiết</button>
                </a>
            </div>
        </div>
    </div>

    @endforeach
    </div>
</div>
@endsection

@section('footer')
    <!--script header-->
    <script src="/assets/js/extrenaljq.js"></script>
    <!--script list-gallery-explore-->
    <script src="/assets/js/phim.js"></script>
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection

