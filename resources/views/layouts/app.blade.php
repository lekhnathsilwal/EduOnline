<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script type="text/javascript" src="{{ asset('js/main.js') }}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}" charset="UTF-8"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"   integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">
</head>
<body>
    <!--<body style=" background: url('/storage/slider images/9.jpg') no-repeat; background-size: 100% 100%;">-->
    <div id="app">
        @include('teacher.inc.navbar')
        @include('student.inc.messages')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
    @include('student.inc.footer')
</body>
</html>
