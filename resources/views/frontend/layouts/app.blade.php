<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Search Engine -->
    <meta name="description" content="NXPlay is an open source streaming entertainment service created with Laravel.">
    <meta name="image" content="https://i.ibb.co/GnwbP81/Nxplay.jpg">
    <!-- Schema.org for Google -->
    <meta itemprop="name" content="NXPlay | No. 1 Online Streaming Site in Bangladesh">
    <meta itemprop="description" content="NXPlay is an open source streaming entertainment service created with Laravel.">
    <meta itemprop="image" content="https://i.ibb.co/GnwbP81/Nxplay.jpg">
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta name="og:title" content="NXPlay | No. 1 Online Streaming Site in Bangladesh">
    <meta name="og:description" content="NXPlay is an open source streaming entertainment service created with Laravel.">
    <meta name="og:image" content="https://i.ibb.co/GnwbP81/Nxplay.jpg">
    <meta name="og:locale" content="en_US, bn_BD">
    <meta name="og:type" content="website">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Watch more things online!</title>

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ asset('icon/favicon-32x32.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('icon/favicon-32x32.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('build/css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('build/css/frontend.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/ionicons@4.3.0/dist/css/ionicons.min.css" rel="stylesheet">
    @yield('styles')
</head>
<body class="body">
@include('frontend.partials._header')
<div id="app">
    @yield('content')
</div>
@includeWhen(request()->routeIs('home'), 'frontend.partials._about')
@include('frontend.partials._footer')
<!-- Scripts -->
<script src="{{ mix('build/js/app.js') }}"></script>
@stack('javascripts')
<script src="{{ mix('build/js/frontend.js') }}"></script>
<script>
    @if(session('message'))
        $.notify("{{ session('message') }}");
    @endif
</script>
</body>
</html>
