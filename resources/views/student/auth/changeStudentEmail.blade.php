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
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'EduOnline') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::guard('student')->user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('student.logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('student.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>
        @if(count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{$error}}
                </div>
            @endforeach
        @endif
        @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
        @endif
        @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
        @endif
        <main class="py-4">
        <div class="container">
            <div class="row">
                <div id="email-form" class="col-md-12 col-md-offset-2" style = "margin-left:50px;">
                    {{ Form::open(['route' =>['changeStudentEmail'], 'method' => 'POST'])}}
                        <div class="row">
                            <div class="col-md-10">
                                {{Form::label('email', 'Email:')}}
                                {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'enter new email'])}}
                            </div>
                            <div class="col-md-10" style = "margin-top:5px;">
                                {{Form::submit('Change', ['class'=>"btn btn-success btn-block"])}}
                    {!!Form::close()!!}
                            </div>
                        </div>
                </div>
            </div>
        </main>
    </div>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
    @include('student.inc.footer')
</body>
</html>
