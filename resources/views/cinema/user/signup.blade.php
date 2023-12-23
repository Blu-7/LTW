<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include("cinema.template.head")
    @include("cinema.template.navbar")
    <link rel="stylesheet" href="/css/login.css"/>
</head>
<body>
<div class="wrapper">
    <div class="logo">
        <img src="/img/logo.png" alt="">
    </div>
    <div class="text-center mt-4 name">
        Hacimi
    </div>
    @include('cinema.user.alert')
    <form class="p-3 mt-3" action="/signup/submit/" method="post">
        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" name="name" id="name" placeholder="Username">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" name="email" id="email" placeholder="Email">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" name="password" id="password" placeholder="Password">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
        </div>
        <button class="btn mt-3 signup"> Đăng ký</button>
        @csrf
    </form>
</div>
@include('cinema.template.footer')
</body>
</html>
