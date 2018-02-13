<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Restaurace') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- jQuery UI styles -->
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/jquery-merged/jquery-1.12.4.js')}}"></script>
    <script src="{{asset('js/jquery-merged/jquery-ui.js')}}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/restaurant.css') }}" rel="stylesheet">

    <!-- Room table styles -->
    <link href="{{ asset('css/restaurant-room-plan.css') }}" rel="stylesheet">

</head>

<body>

<nav class="navbar fixed-top navbar-toggleable-md navbar-expand-sm">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Restaurace Kukačka</a>
        </div>
        <div id="restaurantNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="{{ Request::is('restaurant') ? 'active' : '' }} nav-item"><a class="nav-link" href="{{route("public.main")}}">DNEŠNÍ MENU</a></li>
                <li class="{{ Request::is('restaurant/reservation') ? 'active' : '' }} nav-item"><a class="nav-link" href="{{route("public.reservation")}}">REZERVACE</a></li>
                <li class="{{ Request::is('restaurant/feedback') ? 'active' : '' }} nav-item"><a class="nav-link" href="{{route("public.feedback")}}">FEEDBACK</a></li>
                <li class="{{ Request::is('restaurant/storno') ? 'active' : '' }} nav-item"><a class="nav-link" href="{{route("public.storno")}}">RUŠENÍ REZERVACE</a></li>
            </ul>
        </div>
</nav>

<!-- Header -->
<div class="container-fluid bg-1 text-center restaurant-header">
    <img src="{{asset('/img/restaurant_header___.jpg')}}" class="img-responsive" alt="Restaurant">
</div>

<main>
    @yield('content')
</main>


</body>
</html>