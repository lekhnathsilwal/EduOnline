@extends('multiauth::layouts.app')
@section('content')
@if (Auth::guard('admin')->guest())
    @else
        <div style="margin-top:20px;" class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{url('admin/search-student')}}" class="search" method="POST"  role="search">
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
        @if(count($students)>0)
            @foreach ($students as $student)
                <div class="well">
                    <div class="row">
                        <div class="col-md-1 col-sm-1">
                            <a href="{{url('admin/student-profile/'.$student->id)}}"><img style="height:60px; width:60px;" src="{{url('/storage/student/profile_picture/'.$student->profile_picture)}}"/></a>
                        </div>
                        <div class="col-md-11">
                            <a href="{{url('admin/student-profile/'.$student->id)}}"><h5>{{$student->name}}</h5></a>
                            <h6>{{$student->user_name}}</h6>
                            <h6>{{$student->email}}</h6>
                        </div>
                    </div>    
                <div><hr><br>
            @endforeach
        @else
            <h5>No result found</h5>
        @endif
    </div>
@endsection