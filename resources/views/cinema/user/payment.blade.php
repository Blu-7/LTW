<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include("cinema.template.head")
    @include("cinema.template.navbar")
    <link rel="stylesheet" href="/css/payment.css"/>
</head>
<body>
<div class="wrapper">
    <div class="logo">
        <img src="/img/logo.png" alt="">
    </div>
    <div class="text-center mt-4 name">
        Vui lòng điền thông tin thanh toán
    </div>
    @include('cinema.user.alert')
    <form class="p-3 mt-3" action="/signup/submit/" method="post">
        <div class="form-field d-flex align-items-center">
            <input type="text" name="fullname" id="fullname" placeholder="Họ và tên">
        </div>
        <div class="form-field d-flex align-items-center">
            <input type="text" name="email" id="email" placeholder="Email">
        </div>
        <div class="form-field d-flex align-items-center">
            <input type="password" name="bankname" id="bankname" placeholder="Tên ngân hàng">
        </div>
        <div class="form-field d-flex align-items-center">
            <input type="password" name="phonenumber_bk" id="phonenumber_bk" placeholder="Số điện thoại Smart banking">
        </div>
        <div class="form-field d-flex align-items-center">
            <input type="password" name="password_bk" id="password_bk" placeholder="Mật khẩu Smart banking">
        </div>
        <a href="{{route('done')}}">
        <button class="btn mt-3" onclick="success()"> Thanh toán</button>
        </a>
        <a href="{{redirect()->route('movie')}}">
        <button class="btn mt-3"> Quay lại</button>
        </a>
        @csrf
    </form>
</div>
@include('cinema.template.footer')
</body>
</html>
<script type="text/javascript">
    function success(){
        window.location.href = "/done";
    }
</script>
