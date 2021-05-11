<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>项目管理 - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover"/>
    <van-nav-bar safe-area-inset-top></van-nav-bar>
    <van-number-keyboard safe-area-inset-bottom></van-number-keyboard>
    <link rel="stylesheet" type="text/css" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{mix('css/main.css')}}">
    @yield('css')
</head>
<body>
<div id="app">
    @yield('content')
</div>
<script type="text/javascript" src="{{mix('js/app.js')}}"></script>
@yield('js')
</body>
</html>
