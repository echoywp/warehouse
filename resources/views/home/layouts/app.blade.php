<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>项目管理 - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover"/>
    <van-nav-bar safe-area-inset-top />
    <van-number-keyboard safe-area-inset-bottom />
    <link rel="stylesheet" type="text/css" href="{{asset('static/css/index.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('static/css/app.css')}}">
    @yield('css')
</head>
<body>
<div id="app">
    <div class="container">
        @yield('content')
    </div>
</div>
<script type="text/javascript" src="{{asset('static/js/vue.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/js/vant.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/js/app.js')}}"></script>
</body>
</html>
