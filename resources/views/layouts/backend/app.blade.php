<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ URL::asset('itic/favicon.ico') }}">
    {{-- <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}"> --}}
    <link href="{{ URL::asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('public/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('public/assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('public/assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('public/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    @yield('css')
</head>
<body class="dark-sidenav enlarge-menu-all">
    @include('layouts.backend.sidebar')
    <div class="page-wrapper">
        @include('layouts.backend.topbar')
        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
            @include('layouts.backend.footer')
        </div>
    </div>
    @include('layouts.backend.vendor-scripts')
</body>
</html>