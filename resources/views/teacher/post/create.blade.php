@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Create Post </h1>
        {!! Form::open(['action' => 'Auth\PostController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('title', 'Subject/Topic')}}
                {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Subject/Topic'])}}
           </div>
           <div class="form-group">
                {{Form::label('post_body', 'Description')}}
                {{Form::textarea('post_body', '', ['class' => 'form-control', 'placeholder' => 'Description'])}}
           </div>
           <div class="form-group">
                {{Form::label('file_name', 'File')}}<br/>
                {{Form::file('file_name[]', ['multiple'])}}
           </div>
           {{Form::submit('Post', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection