<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('plugins/materialize/materialize.min.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('plugins/jquery/jquery.min.js')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('plugins/jquery/jquery.lazyload.min.js') }}"></script>
    @stack('css')
</head>
<body>
    @yield('content')


    <div class="modal" id="modal">

    </div>
    <script src="{{asset('plugins/materialize/materialize.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/js.js')}}"></script>
    <script src="{{asset('js/init.js')}}"></script>
    @if (session()->has('message'))
    <script>
        M.toast({
            html: '{{session()->get('message')}}',
            classes:'{{session()->get('classes')}}'
        });
    </script>
    @endif
    @stack('js')
</body>
</html>
