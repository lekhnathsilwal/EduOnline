<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EduOnline') }} :: Student</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Js for slider -->
    <script type="text/javascript" src="{{ asset('js/main.js') }}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{ asset('js/custom.js') }}" charset="UTF-8"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Css for slider -->
    <!-- <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"   integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>    
</head>
<body>
    <div id="app">
        @include('student.inc.verifiedOrNot')
        @include('student.inc.navbar')
        @include('student.inc.messages')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
    @include('student.inc.footer')
</body>
</html>
