@extends('multiauth::layouts.app') 
@section('content')
    <div class="container">
        <h3>Teacher Requests</h3>
        @if(count($users) > 0)
            <?php $count=0; ?>
            @foreach ($users as $user)
                @if($user->verification == "notdone")
                    <?php $count=1; ?>
                    <div class="well">
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <img style="width:150px; height:150px; border: 2px solid black;" src="{{url('/storage/teacher/profile_picture/'.$user->profile_picture)}}"/>
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <h5><a href="{{url('admin/teacher-profile/'.$user->id)}}">{{$user->user_name}}</a></h5>
                                <small>Requested on : {{$user->created_at}}</small><br/><br/>
                                <a onclick="return confirm('Are You Sure??')" href="{{url('admin/teacher-confirm/'.$user->id)}}" class="btn btn-success">Confirm</a> &nbsp;&nbsp;
                                <a onclick="return confirm('Are You Sure??')" href="{{url('admin/teacher-delete/'.$user->id)}}" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div><br/><hr/><br/>
                @endif
            @endforeach
            @if($count == 0)
                <p>There is no teacher request</p>
            @endif
        @else
            <p>There is no any users</p>
        @endif
    </div>
@endsection