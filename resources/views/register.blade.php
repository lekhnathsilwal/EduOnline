@extends('app')
@section('content')
    <div class="jumbotron text-center">
        <h1>Sign-Up</h1>
        <p><a class="btn btn-primary btn-lg" href="{{ route('student.register') }}" role="button">{{ __('Register As Student') }}</a>&emsp;<a class="btn btn-success btn-lg" href="{{ route('register') }}" role="button">{{ __('Register As Teacher') }}</a>
    </div>
@endsection