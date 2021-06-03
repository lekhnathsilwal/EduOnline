@extends('app')
@section('content')
    <div class="jumbotron text-center">
        <h1>Log-In</h1>
        <p><a class="btn btn-primary btn-lg" href="{{ route('student.login') }}" role="button">{{ __('Log-In As Student') }}</a>&emsp;<a class="btn btn-success btn-lg" href="{{ route('login') }}" role="button">{{ __('Log-In As Teacher') }}</a>
    </div>
@endsection