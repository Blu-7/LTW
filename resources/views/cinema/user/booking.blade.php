@extends('cinema.template.main')
@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/booking.css"/>
@endsection
@section('content')
<div class="bodyyyy">
<div class="movie-container">
    <!-- movie's name -->
    <label>Tên phim:</label>
    <select id="movie">
        <option value="45000">{{$movie->name}}</option>
    </select>
    <input type="hidden" value="{{$movie->id}}" class="movie-id">
    <input type="hidden" value="{{$movie->name}}" class="movie-name">
    <input type="hidden" value="{{Auth::user()['id']}}" class="user-id">
    <br>
    <!-- showtime -->
    <label>Suất chiếu:</label>
</div>

    <!-- seat classification -->
    <ul class="showcase">
        <li>
            <div class="seat"></div>
            <small>Ghế chưa chọn</small>
        </li>
        <li>
            <div class="seat occupied"></div>
            <small>Ghế đã chọn</small>
        </li>
        <li>
            <div class="seat selected"></div>
            <small>Ghế đang chọn</small>
        </li>
    </ul>


    <div class="container">
        <p class="text-center">
            Màn hình
        </p>
        <div class="screen"></div>

        <div class="row">
            <div class="seat" id="seat-1" name="1"></div>
            <div class="seat" id="seat-2" name="2"></div>
            <div class="seat" id="seat-3" name="3"></div>
            <div class="seat" id="seat-4" name="4"></div>
            <div class="seat" id="seat-5" name="5"></div>
            <div class="seat" id="seat-6" name="6"></div>
            <div class="seat" id="seat-7" name="7"></div>
            <div class="seat" id="seat-8" name="8"></div>
            <div class="seat" id="seat-9" name="9"></div>
            <div class="seat" id="seat-10" name="10"></div>
        </div>
        <div class="row">
            <div class="seat" id="seat-11" name="11"></div>
            <div class="seat" id="seat-12" name="12"></div>
            <div class="seat" id="seat-13" name="13"></div>
            <div class="seat" id="seat-14" name="14"></div>
            <div class="seat" id="seat-15" name="15"></div>
            <div class="seat" id="seat-16" name="16"></div>
            <div class="seat" id="seat-17" name="17"></div>
            <div class="seat" id="seat-18" name="18"></div>
            <div class="seat" id="seat-19" name="19"></div>
            <div class="seat" id="seat-20" name="20"></div>
        </div>
        <div class="row">
            <div class="seat" id="seat-21" name="21"></div>
            <div class="seat" id="seat-22" name="22"></div>
            <div class="seat" id="seat-23" name="23"></div>
            <div class="seat" id="seat-24" name="24"></div>
            <div class="seat" id="seat-25" name="25"></div>
            <div class="seat" id="seat-26" name="26"></div>
            <div class="seat" id="seat-27" name="27"></div>
            <div class="seat" id="seat-28" name="28"></div>
            <div class="seat" id="seat-29" name="29"></div>
            <div class="seat" id="seat-30" name="30"></div>
        </div>
        <div class="row">
            <div class="seat" id="seat-31" name="31"></div>
            <div class="seat" id="seat-32" name="32"></div>
            <div class="seat" id="seat-33" name="33"></div>
            <div class="seat" id="seat-34" name="34"></div>
            <div class="seat" id="seat-35" name="35"></div>
            <div class="seat" id="seat-36" name="36"></div>
            <div class="seat" id="seat-37" name="37"></div>
            <div class="seat" id="seat-38" name="38"></div>
            <div class="seat" id="seat-39" name="39"></div>
            <div class="seat" id="seat-40" name="40"></div>
        </div>
        <div class="row">
            <div class="seat" id="seat-41" name="41"></div>
            <div class="seat" id="seat-42" name="42"></div>
            <div class="seat" id="seat-43" name="43"></div>
            <div class="seat" id="seat-44" name="44"></div>
            <div class="seat" id="seat-45" name="45"></div>
            <div class="seat" id="seat-46" name="46"></div>
            <div class="seat" id="seat-47" name="47"></div>
            <div class="seat" id="seat-48" name="48"></div>
            <div class="seat" id="seat-49" name="49"></div>
            <div class="seat" id="seat-50" name="50"></div>
        </div>
        <div class="row">
            <div class="seat" id="seat-51" name="51"></div>
            <div class="seat" id="seat-52" name="52"></div>
            <div class="seat" id="seat-53" name="53"></div>
            <div class="seat" id="seat-54" name="54"></div>
            <div class="seat" id="seat-55" name="55"></div>
            <div class="seat" id="seat-56" name="56"></div>
            <div class="seat" id="seat-57" name="57"></div>
            <div class="seat" id="seat-58" name="58"></div>
            <div class="seat" id="seat-59" name="59"></div>
            <div class="seat" id="seat-60" name="60"></div>
        </div>
    </div>

    <p class="text">
        Bạn đã chọn <span id="count"></span> ghế, tổng tiền: <span id="total"></span>
    </p>
    <button class="button" onclick="Pay()">Thanh toán</button>
</div>
</div>
@endsection

@section('footer')
    <script type="text/javascript" defer src="/assets/js/booking.js"></script>
@endsection
