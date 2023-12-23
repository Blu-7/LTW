<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include("cinema.template.head")
    @include("cinema.template.navbar")
    <link rel="stylesheet" href="/css/intro.css"/>
    <link rel="stylesheet" href="/css/navbar.css"/>
</head>
<body>

@include('cinema.template.footer')
</body>
</html>
