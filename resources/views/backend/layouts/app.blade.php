<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ asset('icon/favicon-32x32.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('icon/favicon-32x32.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/ionicons@4.3.0/dist/css/ionicons.min.css" rel="stylesheet">
    @yield('styles')
    <script src="https://unpkg.com/turbolinks"></script>
</head>
<body>
@include('backend.partials._header')
@includeWhen(Auth::check(), 'backend.partials._sidebar')
<div id="app">

    @auth
        <main class="main">
            @endauth
            @yield('content')
            @auth
        </main>
    @endauth

    @yield('modal')
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@stack('javascripts')
<script src="{{ asset('js/admin.js') }}" defer></script>
<script>
    Echo.channel('video-created')
        .listen('VideoCreated', (e) => {
            $.notify({
                icon: 'https://image.tmdb.org/t/p/w92/' + e.video.poster,
                message: e.video.title + ' ' + e.video.type + ' has been published now',
                url: e.video.slug,
                target: "_self"
            },{
                icon_type: 'image',
                showProgressbar: true,
                delay: 5000,
                mouse_over: 'pause',
            });
        });
</script>
</body>
</html>
