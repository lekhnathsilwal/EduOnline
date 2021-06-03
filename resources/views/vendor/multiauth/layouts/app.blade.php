<?php use App\User; 
use App\Payment_request;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EduOnline') }} {{ ucfirst(config('multiauth.prefix')) }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('admin.home') }}">
                    {{ config('app.name', 'EduOnline') }} <!--{{ ucfirst(config('multiauth.prefix')) }}-->
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @if (Auth::guard('admin')->guest())
                    @else
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.home') }}">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <?php
                                $users = User::all(); 
                                $rqCount=0;
                                foreach($users as $user){
                                    if($user->verification == "notdone"){
                                        $rqCount++;
                                    }
                                }
                                $preq = Payment_request::all()->count();
                                ?>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.teacher-request') }}">Teacher Request
                                <span class="badge" style="font-size:12px; background:red; color:white; position:relative; top:-15px; left:-5px;"><?php if($rqCount>0){ echo $rqCount; } ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.teachers-list') }}">Teachers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.students-list') }}">Students</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('admin/payment-request') }}">Payment request
                                    <span class="badge" style="font-size:12px; background:red; color:white; position:relative; top:-15px; left:-5px;"><?php if($preq>0){ echo $preq; } ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('admin/most-liked-posts')}}">Most liked posts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('admin/site')}}">Site</a>
                            </li>
                        </ul>
                    @endif
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.login')}}">{{ ucfirst(config('multiauth.prefix')) }} Login</a>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" v-pre>
                                    {{ auth('admin')->user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @admin('super')
                                    <a class="dropdown-item" href="{{ route('admin.show') }}">{{ ucfirst(config('multiauth.prefix')) }}</a>
                                    <a class="dropdown-item" href="{{ route('admin.roles') }}">Roles</a>
                                @endadmin
                                    <a class="dropdown-item" href="{{ route('admin.password.change') }}">Change Password</a>
                                <a class="dropdown-item" href="/admin/logout" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @include('student.inc.messages')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('student.inc.footer')
</body>

</html>