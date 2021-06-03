@extends('multiauth::layouts.app')
@section('content')
@if (Auth::guard('admin')->guest())
@else
    <div style="margin-top:20px;" class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{url('admin/search-teacher')}}" class="search" method="POST"  role="search">
                    @csrf
                    <input style="background:rgba(51, 153, 51, 0.1); border:none;" class="form-control" type="text" name="search" placeholder="Search" aria-label="Search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
@endif<br>
    <div class="container">
        <h4>Results</h4><br><hr>
        @if(count($teachers)>0)
            @foreach ($teachers as $teacher)
                <div class="well">
                    <div class="row">
                        <div class="col-md-1 col-sm-1">
                            <a href="{{url('admin/teacher-profile/'.$teacher->id)}}"><img style="height:60px; width:60px;" src="{{url('/storage/teacher/profile_picture/'.$teacher->profile_picture)}}"/></a>
                        </div>
                        <div class="col-md-11">
                            <a href="{{url('admin/teacher-profile/'.$teacher->id)}}"><h5>{{$teacher->name}}</h5></a>
                            <h6>{{$teacher->email}}</h6>
                            <h6>{{$teacher->title}}</h6>
                        </div>
                    </div>    
                <div><hr><br>
                    @foreach ($teacher->posts as $post)
                    <div class="well">
                        <div class="row">
                            <div class="col-md-1 col-sm-1">
                                <a href="{{url('admin/teacher-profile/'.$teacher->id)}}"><img style="width:60px; height:60px; float:left; border: 1px solid black;" src="{{url('/storage/teacher/profile_picture/'.$post->user->profile_picture)}}"/>
                            </div>
                            <div class="col-md-11">
                                <a href="{{url('teacher-profile/'.$post->user->id)}}"><h5>{{$post->user->name}}</h5></a>
                                <p>{{$post->user->user_name}}</p>
                                <h5>{{$post->title}}</h5>
                                <h5>{{$post->post_body}}</h5>
                            </div>
                        </div>                  
                        <br>
                        @if($post->created_at == $post->updated_at)
                            <small style="margin-left: 60px;">Created at: {{$post->created_at}}&emsp;&emsp;</small>
                        @else
                            <small style="margin-left: 60px;">Updated at: {{$post->updated_at}}&emsp;&emsp;</small>
                        @endif
                    </div><br><hr><br>                 
                    @endforeach
            @endforeach
        @else
            <h5>No result found</h5>
        @endif
    </div>
@endsection