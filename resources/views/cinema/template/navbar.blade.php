<link rel="stylesheet" href="/css/navbar.css">
<nav class="navbar navbar-expand-lg navbar-light bg-cyan">
    <img class="navbar-logo" width="100" src="/img/logo.png" alt=""/><br>
    <a class="navbar-brand-custom" href="/index">TRANG CHỦ</a>
    <a class="navbar-brand-custom" href="/intro">GIỚI THIỆU</a>
    <a class="navbar-brand-custom" href="/movie">PHIM</a>
    <a class="navbar-brand-custom" href="/contact">LIÊN HỆ</a>
    @if(Auth::user()['id'])
{{--Hiển thị các items trên thanh navbar--}}
        <a class="navbar-brand-custom nav-item ms-auto">Xin chào {{Auth::user()['name']}}</a>
        <a class="navbar-brand-custom nav-item ms-2" href='{{route('signout')}}'>Đăng xuất</a>
    @else
        <a class="navbar-brand-custom nav-item ms-auto" href='{{route('signin')}}'>Đăng nhập</a>
        <a class="navbar-brand-custom nav-item ms-2" href='{{route('signup')}}'>Đăng ký</a>
    @endif
</nav>
