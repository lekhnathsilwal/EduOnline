@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Payment_request </h1>
        {{ Form::open(['route' =>['payment.store', Auth::user()->id], 'method' => 'POST'])}}
            <div class="form-group">
                {{Form::label('bank_name', 'Bank Name')}}
                {{Form::text('bank_name', '', ['class' => 'form-control', 'placeholder' => 'Bank Name'])}}
           </div>
           <div class="form-group">
                {{Form::label('account_number', 'Account number')}}
                {{Form::text('account_number', '', ['class' => 'form-control', 'placeholder' => 'Account_number'])}}
           </div>
           <div class="form-group">
                {{Form::label('account_holder', 'Account holder name')}}
                {{Form::text('account_holder', '', ['class' => 'form-control', 'placeholder' => 'Account holder name'])}}
           </div>
           {{Form::submit('Request', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection