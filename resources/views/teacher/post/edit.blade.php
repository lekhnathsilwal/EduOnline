@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Edit Post </h1>
        {!! Form::open(['action' => ['Auth\PostController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
           </div>
           <div class="form-group">
                {{Form::label('post_body', 'Body')}}
                {{Form::textarea('post_body', $post->post_body, ['class' => 'form-control', 'placeholder' => 'Body Text'])}}
           </div>
           <div class="form-group">
               <h5>Files</h5><br>
                @foreach ($post->postfiles as $file)
                {{$file->file_name}}&nbsp;&emsp;&emsp;&emsp;<a onclick="return confirm('Are You Sure??')" style="margin-right: 80px;" href="{{url('deleteFile/'.$file->id)}}">Delete</a><br>
                @endforeach
            </div>
            <div class="form-group">
                {{Form::label('file_name', 'Add File')}}
                {{Form::file('file_name[]', ['multiple'])}}
           </div>
           <div class="form-group" style="float:left;">
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
           </div>
        {!! Form::close() !!}
        <div class="form-group" style="margin-left:80px;">
            {!!Form::open(['action' => ['Auth\PostController@destroy', $post->id], 'method' => 'POST'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete Post', ['class'=>"btn btn-danger", 'float' => 'right', 'margin-left'=> '100px'])}}
            {!!Form::close()!!}
        </div>
    </div>
@endsection