@extends('multiauth::layouts.app')
@section('content')
    <div class="container">
            <div style="height:150px;" class="col-md-2 col-sm-2">
                <img style="width:150px; height:150px; float: right; border: 2px solid black;" src="{{url('/storage/student/profile_picture/'.$student->profile_picture)}}"/>
            </div><hr>
            <div class="col-md-10 col-sm-10">
                <h4>Id &nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;{{$student->id}}</h4>
                <h4>Name &nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;{{$student->name}}</h4>
                <h4>Faculty &nbsp;&nbsp;:&emsp;{{$student->faculty}}</h4>
                <h4>Program :&emsp;{{$student->program}}</h4>
                <h4>Email &nbsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;{{$student->email}}</h4>
            </div>
            <br/><hr/>
        <a onclick="return confirm('Are You Sure??')" href="{{url('admin/student-delete/'.$student->id)}}" class="btn btn-danger">Delete</a>
    </div>
@endsection