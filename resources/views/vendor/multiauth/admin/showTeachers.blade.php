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
        <h3>Teachers</h3>
        @if(count($users) > 0)
            <?php $count = 0; ?>
            @foreach ($users as $user)
                <div class="well">
                    @if($user->verification == "done")
                        <?php $count = 1; ?>
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <img style="width:150px; height:150px; border: 2px solid black;" src="{{url('/storage/teacher/profile_picture/'.$user->profile_picture)}}"/>
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <h5><a href="{{url('admin/teacher-profile/'.$user->id)}}">{{$user->user_name}}</a></h5>
                                <small>Updated on : {{$user->updated_at}}</small><br/><br/>
                                <a href="{{url('admin/teacher-profile/'.$user->id)}}" class="btn btn-primary">Visit Profile</a> &nbsp;&nbsp;                                
                            </div>
                        </div><br/><hr/><br/>
                    @endif
                    @if($count == 0)
                        <p>No one is accepted as teacher</p>
                    @endif
                </div>
            @endforeach
        @else
            <p>There is no any users</p>
        @endif
    </div>
@endsection