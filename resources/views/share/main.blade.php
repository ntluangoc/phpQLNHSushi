<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <script src="{{ asset('assets/javascript/jquery-3.5.1.min.js') }}"></script>
    <style>
        .toast:not{
            display:block;
        }

    </style>
    @yield('css')
    <link rel="stylesheet" href="{{ asset('assets/css/L_header.css') }}">
</head>
<body>
@include('share.header')
@yield('content')

@include('share.footer')
</body>
</html>
