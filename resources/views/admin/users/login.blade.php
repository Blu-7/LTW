<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include("template.head")
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
    @include('user.alert')
    <form class="p-3 mt-3" action="/admin/submit/" method="post">
        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" name="email" id="email" placeholder="Email">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" name="password" id="password" placeholder="Password">
        </div>
        <div class="col-8">
            <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">
                    Ghi nhớ đăng nhập
                </label>
            </div>
        </div>
        <button class="btn mt-3 signin">Login</button>
        @csrf
    </form>
    <button class="btn mt-3 signup"> Sign up</button>
</div>
@include('template.footer')
</body>
</html>
