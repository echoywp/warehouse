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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('css')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm top-title">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', '库存管理') }}
            </a>
            <ul class="navbar-nav ml-auto top-nav" style="flex-direction: inherit">
                @guest
                @else
                <li class="nav-item" style="margin-right: 5px">
                    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                </li>
                <li>
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" style="color: #fff">
                        {{ __('退出') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @endguest
            </ul>
        </div>
    </nav>

    <main class="py-4 main-content">
        @yield('content')
    </main>
</div>
<script type="text/javascript" src="{{mix('js/app.js')}}"></script>
@yield('js')
</body>
</html>
