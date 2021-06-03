@extends('multiauth::layouts.app') 
@section('content')
<?php use App\User;
        use App\Student; 
        use App\Post; 
        use App\Payment_request; 
        use App\Rating_info;
?>
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
        @if(count($payments) > 0)
            @foreach ($payments as $payment)
            <?php $user_id=$payment->user_id; 
            $user = User::find($user_id);
            ?>
                <div class="well">
                    <div class="post_head">
                        <a href="{{url('/storage/teacher/profile_picture/'.$user->profile_picture)}}"><img style="width:50px; border: 20px solid; border-color:white; height:50px; margin-left:7px; border-radius:25px; margin-top:7px; float:left; border: 1px solid black;" src="{{url('/storage/teacher/profile_picture/'.$user->profile_picture)}}"/></a>
                        <a href="{{url('admin/teacher-profile/'.$user->id)}}"><h4 style="margin-left: 70px; padding-top:5px; text-transform: capitalize;">{{$user->name}}</h4></a>
                    </div>
                    <p style="margin-left: 70px;">{{$user->email}}</p>
                    <h5 style="margin-left: 70px;">Bank Name : {{$payment->bank_name}}</h5>
                    <h5 style="margin-left: 70px;">Account Holder : {{$payment->account_holder}}</h5>
                    <h5 style="margin-left: 70px;">Account Number : {{$payment->account_number}}</h5>
                    <h5 style="margin-left: 70px;">Amount To Pay : $ {{$user->available_balance}}</h5>
                    <br>
                    @if($payment->created_at == $payment->updated_at)
                        <small style="margin-left: 60px;">Created at: {{$payment->created_at}}&emsp;&emsp;</small>
                    @else
                        <small style="margin-left: 60px;">Updated at: {{$payment->updated_at}}&emsp;&emsp;</small>
                    @endif
                </div>
                <br>
                    <a onclick="return confirm('Are You Sure??')" href="{{url('admin/clear_payment/'.$payment->id)}}"><button class="btn btn-primary">Claer payment</button></a>
                <br><hr><br>
            @endforeach
        @else
            <p> No any payment request found </p>
        @endif
    </div>
@endsection