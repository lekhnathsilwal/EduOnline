@extends('student.layouts.app')
@section('content')
    @if (Auth::guard('student')->guest())
    @else
        <div style="margin-top:20px;" class="container">
            <div class="row">
                <div class="offset-1 col-md-8">
                    <form action="{{url('student/search-teacher')}}" method="POST"  role="search">
                        @csrf
                        <input style="background:rgba(51, 153, 51, 0.1);" class="form-control" type="text" name="search" placeholder="Search" aria-label="Search">
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
                                <a href="{{url('show-teacher-profile/'.$teacher->id)}}"><img style="height:60px; width:60px;" src="{{url('/storage/teacher/profile_picture/'.$teacher->profile_picture)}}"/></a>
                        </div>
                        <div class="col-md-11">
                            <a href="{{url('show-teacher-profile/'.$teacher->id)}}"><h5>{{$teacher->name}}</h5></a>
                            <h6>{{$teacher->user_name}}</h6>
                            <h6>{{$teacher->email}}</h6>
                        </div>
                    </div>    
                <div><hr><br>
            @endforeach
        @else
            <h5>No result found</h5>
        @endif
    </div>
@endsection