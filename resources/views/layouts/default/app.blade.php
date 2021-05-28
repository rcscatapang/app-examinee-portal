<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    {{--Favicon--}}
    <link rel="icon" href="{{ asset('img/brand/favicon.png') }}" type="image/png">
    {{--Fonts--}}
    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">--}}
    {{--Styles--}}
    <link href="{{ asset('vendor/nucleo/css/nucleo.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    {{--Custom Page Styles--}}
    @yield('styles')
    <link href="{{ asset('css/argon.css?v=1.0.0') }}" rel="stylesheet" type="text/css">
</head>

<body class="bg-blue">
<nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand">
            <img src="{{ asset('img/brand/logo-white.png') }}" class="img-fluid" style="min-height: 35px;">
        </a>
    </div>
</nav>

<div class="main-content">
    <div class="header bg-blue py-3 py-lg-8 pt-lg-9">
        <div class="container">
            @yield('header')
        </div>
    </div>
    <div class="container mt--8 pb-5">
        @yield('content')
    </div>
</div>
</body>
