<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include("cinema.template.head")
    @include("cinema.template.navbar")
</head>
<body>
    @include('cinema.user.alert')
    @yield('slideshow')
    @yield('content')
</div>
@include('cinema.template.footer')
</body>
</html>
