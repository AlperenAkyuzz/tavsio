<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <title>@yield('title') | Tavsio</title>
    <link rel="icon" href="{{ asset('frontend/images/fav.png') }}" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="{{ asset('frontend/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/toast-notification.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    {{-- @if($settings->theme == 'dark') --}}
    <!--<link rel="stylesheet" href="{{ asset('frontend/css/dark-theme.css') }}">-->
    {{-- @endif --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    @yield('css')
</head>
<body>
@include('frontend.layouts.modules.preloader',[ $active = false ])
<div class="theme-layout">
    @include('frontend.layouts.responsive-header')
    @include('frontend.layouts.header')
    @include('frontend.layouts.sidebar')

    @yield('content')

</div>

@yield('popup')

<script src="{{ asset('frontend/js/main.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-stories.js') }}"></script>
<script src="{{ asset('frontend/js/toast-notificatons.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js"></script><!-- For timeline slide show -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script><!-- for location picker map -->
<script src="{{ asset('frontend/js/locationpicker.jquery.js') }}"></script><!-- for loaction picker map -->
<script src="{{ asset('frontend/js/map-init.js') }}"></script><!-- map initilasition -->
<script src="{{ asset('frontend/js/script.js') }}"></script>
@yield('js')
</body>
</html>
