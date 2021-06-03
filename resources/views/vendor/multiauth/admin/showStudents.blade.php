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
        <h3>Students</h3>
        @if(count($students) > 0)
            @foreach ($students as $student)
                <div class="well">
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <img style="width:150px; height:150px; border: 2px solid black;" src="{{url('/storage/student/profile_picture/'.$student->profile_picture)}}"/>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <h5><a href="{{url('admin/student-profile/'.$student->id)}}">{{$student->name}}</a></h5>
                            <small>Updated on : {{$student->updated_at}}</small><br/><br/>
                            <a href="{{url('admin/student-profile/'.$student->id)}}" class="btn btn-primary">Visit Profile</a> &nbsp;&nbsp;                                
                        </div>
                    </div><br/><hr/><br/>
                </div>
            @endforeach
        @else
            <p>There is no any Students</p>
        @endif
    </div>
@endsection