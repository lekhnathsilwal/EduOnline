<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('student.dashboard') }}">
            {{ config('app.name', 'EduOnline') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            @if (Auth::guard('student')->guest())
            @else
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.dashboard') }}">Home<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('student/student-profile/'.Auth::guard('student')->user()->id)}}">Profile<span class="sr-only">(current)</span></a>
                    </li>       
                </ul>
            @endif
            <!-- Right Side Of Navbar -->
            {{-- <form method="POST" action="#" role="search">
                @csrf
                <div class="input-group">
                        <input type="text" class="form-control" placeholder="teacher name" name="name">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                </div>
            </form> --}}
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @if (Auth::guard('student')->guest())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::guard('student')->user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">                
                            <a class="dropdown-item" href="{{url('student/change-password/'. Auth::guard('student')->user()->id )}}">Change Password</a>                                
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
                @endguest
            </ul>
        </div>
    </div>
</nav>