@extends('multiauth::layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Circle News') }}</div>
                <div class="card-body">
                    {!! Form::open(['action' => ['Admin\CircleNewsController@update', $circleNews->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group row">
                            {{Form::label('heading', 'Heading')}}
                            {{Form::text('heading', $circleNews->heading, ['class' => 'form-control'])}}
                            @if ($errors->has('heading'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('heading') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group row">
                            {{Form::label('description', 'Description')}}
                            {{Form::textarea('description', $circleNews->description, ['class' => 'form-control'])}}
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif
                        </div>
                        {{Form::label('file', 'File')}}<br/>
                        {{Form::file('file')}}
                        @if ($errors->has('file'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('file') }}</strong>
                            </span>
                        @endif
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {{Form::hidden('_method', 'PUT')}}
                                {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
