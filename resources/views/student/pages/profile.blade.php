@extends('student.layouts.app')
@section('content')
    <div class="container">
        <div style="height:150px;" class="col-md-2 col-sm-2">
            <a href="{{url('/storage/student/profile_picture/'.$student->profile_picture)}}"><img style="width:150px; height:150px; float: right; border: 2px solid black;" src="{{url('/storage/student/profile_picture/'.$student->profile_picture)}}"/></a>
        </div><hr/>
        <div class="col-md-10 col-sm-10">
            <h4>Id &nbsp;&emsp;&emsp;&emsp;:&emsp;{{$student->id}}</h4>
            <h4>Name &nbsp;&emsp;:&emsp;{{$student->name}}</h4>
            <h4>Email &nbsp;&nbsp;&emsp;:&emsp;{{$student->email}}</h4>
            <h4>Faculty &nbsp;&nbsp;&nbsp;:&emsp;{{$student->faculty}}</h4>
            <h4>Program &nbsp;:&emsp;{{$student->program}}</h4>
            <h4>College &nbsp;:&emsp;{{$student->college}}</h4>
            @if(Auth::guard('student')->user()->id == $student->id)
                <a style="float:right;margin-right:250px;" href="{{url('edit-student-profile/'.$student->id)}}" class="btn btn-primary">Edit Profile</a> &nbsp;&nbsp;
            @endif
        </div>
    </div>
@endsection