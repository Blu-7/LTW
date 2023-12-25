<link rel="stylesheet" href="/css/navbar.css">
{{--<div id="navbar">--}}
<nav class="navbar navbar-expand-lg navbar-light bg-cyan">
    <img class="navbar-logo" width="100" src="/img/logo.png" alt=""/><br>
    <a class="navbar-brand-custom" href="/index">TRANG CHỦ</a>
    <a class="navbar-brand-custom" href="/intro">GIỚI THIỆU</a>
    <a class="navbar-brand-custom" href="/movie">PHIM</a>
    <a class="navbar-brand-custom" href="/contact">LIÊN HỆ</a>
{{--    @if(\Illuminate\Support\Facades\Auth::user()->id)--}}
{{--    @if(Auth::user()->id)--}}
    @if(Auth::user()['id'])
{{--        <a class="navbar-brand-custom nav-item ms-auto">Xin chào {{Auth::user()->name}}</a>--}}
{{--        <a class="navbar-brand-custom nav-item ms-auto">Xin chào {{\Illuminate\Support\Facades\Auth::user()->name}}</a>--}}
{{--        <a class="navbar-brand-custom nav-item ms-auto">Xin chào {{Auth::user()->name}}</a>--}}
        <a class="navbar-brand-custom nav-item ms-auto">Xin chào {{Auth::user()['name']}}</a>
        <a class="navbar-brand-custom nav-item ms-2" href='{{route('signout')}}'>Đăng xuất</a>
    @else
        <a class="navbar-brand-custom nav-item ms-auto" href='{{route('signin')}}'>Đăng nhập</a>
        <a class="navbar-brand-custom nav-item ms-2" href='{{route('signup')}}'>Đăng ký</a>
    @endif
{{--    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--        <span class="navbar-toggler-icon"></span>--}}
{{--    </button>--}}
{{--    <div class="collapse navbar-collapse" id="navbarNav">--}}
{{--        <ul class="navbar-nav">--}}
{{--            <li class="nav-item active">--}}
{{--                <a class="nav-link" href="#">GIỚI THIỆU<span class="sr-only">(current)</span></a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#">PHIM</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#">LIÊN HỆ</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link disabled" href="#">Disabled</a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </div>--}}
</nav>
{{--</div>--}}
