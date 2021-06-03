@extends('layouts.app')
@section('content')
    <?php use App\User;
        use App\Student; 
        use App\Post; 
        use App\Payment_request; 
        function getLikes($id){
            $sql = "SELECT COUNT(*) FROM rating_infos 
                    WHERE post_id = $id AND rating_action='like'";
            $rs = mysqli_query(mysqli_connect('localhost', 'root', '0434', 'eduonline'), $sql);
            $result = mysqli_fetch_array($rs);
            return $result[0];
        }
        function payable($id){
            $total_likes=getLikes($id);
            if($total_likes>3){
                $payable=($total_likes/100);
                $post=Post::find($id);
                $post->total_likes=$total_likes;
                $post->payed_upto=$post->payed_upto;
                $post->payable=$payable;
                $post->save();
                return $payable;
            }else{
                return 0;
            }
        }
        // Check if user already likes post or not
        function userLiked($post_id)
        {
            $user_id=Auth::user()->id;
            $res=DB::select("select * from rating_infos where post_id=? and user_id=? and rating_action='like' and user_type='teacher'",[$post_id,$user_id]);
            return $res;
        } ?>
    <div class="container">
        <div class="row">
            <?php $available_balance=0.00;
            if(Auth::user()->id == $teacher->id){
                if(count($teacher->posts) > 0){
                    foreach ($teacher->posts as $post){
                        $available_balance = $available_balance + payable($post->id);
                    }
                    $user=User::find($teacher->id);
                    $user->available_balance = $available_balance;
                    $user->save();
                }
            } ?>
            <div style="height:275px; float:left;" class="col-md-3 col-sm-3">
                <a href="{{url('/storage/teacher/profile_picture/'.$teacher->profile_picture)}}"><img style="height:275px; width:270px; border: 2px solid black;" src="{{url('/storage/teacher/profile_picture/'.$teacher->profile_picture)}}"/></a>
                <!--transform: rotate(90deg);-->
            </div>
            <div class="col-md-9 col-sm-9">
                <h4>Name &emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:&emsp;{{$teacher->name}}</h4>
                <h4>User Name &emsp;&emsp;&emsp;:&emsp;{{$teacher->user_name}}</h4>
                <h4>Address &nbsp;&emsp;&emsp;&emsp;&emsp;:&emsp;{{$teacher->address}}</h4>
                <h4>Contact &nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;:&emsp;{{$teacher->contact}}</h4>
                <h4>Engaged College &nbsp;&nbsp;:&emsp;{{$teacher->engaged_college}}</h4>
                <h4>Teaching Faculty &nbsp;&nbsp;:&emsp;{{$teacher->teaching_faculty}}</h4>
                <h4>Teaching Program :&emsp;{{$teacher->teaching_program}}</h4>
                <h4>Email &nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&emsp;{{$teacher->email}}</h4>
                <h4>Available Balance : $ {{$available_balance}}</h4>
                <?php         
                    if($available_balance>0.001){
                        $payment = Payment_request::where('user_id', Auth::user()->id);
                        if(Auth::user()->id == $teacher->id){?>
                            <a href="{{url('payment_request')}}"> Request for payment</a>
                <?php } } ?>
            </div>
        </div><br>
                    @if(Auth::user()->id == $teacher->id)
                            <a style="margin-top:5px; float:left;" href="{{url('edit-profile/'.$teacher->id)}}" class="btn btn-primary">Edit Profile</a> &nbsp;&nbsp;
                    @endif
                <!-- @if(Auth::user()->id == $teacher->id)
                    <h1> My Documents </h1><hr><br>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <h5>Citizenship</h5>
                            <a href="{{url('/storage/teacher/citizenship/'.$teacher->citizenship)}}"><img style="width:100%; height:300px; border: 4px solid black;" src="{{url('/storage/teacher/citizenship/'.$teacher->citizenship)}}"/></a>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <h5>Teacher Card</h5>
                            <a href="{{url('/storage/teacher/teacher_card/'.$teacher->teacher_card)}}"><img style="width:100%; height:300px; border: 4px solid black;" src="{{url('/storage/teacher/teacher_card/'.$teacher->teacher_card)}}"/></a>
                        </div>
                    </div>
                @endif -->
                <br><br><hr><h1>Posts </h1><hr><br>
                @if(count($teacher->posts) > 0)
                    @foreach ($teacher->posts as $post)
                        <div class="well">
                            <div class="post_head">
                                <a href="{{url('/storage/teacher/profile_picture/'.$post->user->profile_picture)}}"><img style="width:50px; border: 20px solid; border-color:white; height:50px; margin-left:7px; border-radius:25px; margin-top:7px; float:left; border: 1px solid black;" src="{{url('/storage/teacher/profile_picture/'.$post->user->profile_picture)}}"/></a>
                                <a href="{{url('teacher-profile/'.$post->user->id)}}"><h4 style="margin-left: 70px; padding-top:5px; text-transform: capitalize;">{{$post->user->name}}</h4></a>
                            </div>
                            <p style="margin-left: 70px;">{{$post->user->email}}</p>
                            <hr  style="background-color: black;">
                            <h4>{{$post->title}}</h4>
                            <h5 style="margin-left: 10px;">{{$post->post_body}}</h5>                   
                            <div class="row">
                                <?php $fileFlag=0; 
                                $filecount=0; ?>
                                @foreach ($post->postfiles as $file)
                                    @if($post->postfiles)
                                        @if($file->file_type=="mp4")
                                            <div class="col-md-12" style="margin-top:10px;">
                                                <video style="width:100%; float:left;" controls>
                                                    <source src="{{url('/storage/teacher/posts/'.$file->file_name)}}" type="video/mp4">
                                                </video>
                                            </div>
                                            <?php $filecount++; ?>
                                        @elseif($file->file_type=="jpg" || $file->file_type=="jpeg" || $file->file_type=="JPEG" || $file->file_type=="JPG" || $file->file_type=="gif")
                                            <div class="col-md-12" style="margin-top:10px;">
                                                <a href="{{url('/storage/teacher/posts/'.$file->file_name)}}"><img style="width:100%;" src="{{url('/storage/teacher/posts/'.$file->file_name)}}"></a>
                                            </div>
                                            <?php $filecount++; ?>
                                        @else
                                            <?php $fileFlag=1; ?>
                                        @endif
                                        <?php if($filecount>1){
                                                goto next;
                                        }?>
                                    @endif
                                @endforeach
                                <?php next: if($filecount>1){ ?>
                                    <a href="{{url('view-all-files/'.$post->id)}}"><button style="margin-top:20px;" class="btn btn-primary">View all files</button></a>
                                <?php } ?>
                            </div>
                            @if($fileFlag==1)
                                <hr><h5>Files</h5>
                                <div class="row">
                                    @foreach ($post->postfiles as $file)
                                        @if($post->postfiles)
                                            @if($file->file_type=="mp4")
                                            @elseif($file->file_type=="jpg" || $file->file_type=="jpeg" || $file->file_type=="JPEG" || $file->file_type=="JPG" || $file->file_type=="gif")
                                            @else
                                                <div class="col-md-12">
                                                    <br><a onclick="return confirm('Do you want to download??')" style="margin-left: 100px;" href="{{url('/storage/teacher/posts/'.$file->file_name)}}" download="{{$file->file_name}}">{{$file->file_name}}</a>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                            @if($post->created_at == $post->updated_at)
                                <small style="margin-left: 60px;">Created at: {{$post->created_at}}</small>
                            @else
                                <small style="margin-left: 60px;">Updated at: {{$post->updated_at}}</small>
                            @endif
                            <div class="post-info">
                                <?php if (userLiked($post->id)){ ?>
                                    <span class="likes"> You and <?php echo getLikes($post->id)-1; ?> other likes this</span><br>
                                    <a style="font-size:1.2em;" href="{{url('teacher_unlikes/'.$post->id)}}"><i class="fa fa-thumbs-up like-btn">&nbsp;<span style="color:blue;" class="l">Like</span></i></a>
                                <?php } else{?>
                                    <span class="likes"><?php echo getLikes($post->id); ?> people likes this</span><br>
                                    <a style="font-size:1.2em;" href="{{url('teacher_likes/'.$post->id)}}"><i class="fa fa-thumbs-o-up like-btn">&nbsp;<span style="color:black;" class="l">Like</span></i></a>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-md-offset-2" style = "margin-left:50px;">
                                    @foreach ($post->comments as $comment)
                                        <br>
                                        <div class="comment">
                                            @if($comment->user_type == 'teacher')
                                                <?php 
                                                    $user = User::find($comment->user_id); ?>
                                                    <a href="{{url('/storage/teacher/profile_picture/'.$user->profile_picture)}}"><img style="width:30px; height:30px; float:left; border: 1px solid black;" src="{{url('/storage/teacher/profile_picture/'.$user->profile_picture)}}"/></a>
                                                    <a href="{{url('teacher-profile/'.$user->id)}}"><h6 style="margin-left: 40px;">{{$user->user_name}}</h6></a>
                                                    <p style="margin-left: 50px;">{{$comment->comment}}
                                                    @if(Auth::user()->id == $user->id)
                                                        &emsp;<a href="{{url('comment/edit/'.$comment->id)}}">Edit</a>
                                                    @endif
                                                    </p>
                                            @elseif($comment->user_type == 'student')
                                                <?php 
                                                    $user = Student::find($comment->user_id); ?>
                                                    <a href="{{url('/storage/student/profile_picture/'.$user->profile_picture)}}"><img style="width:30px; height:30px; float:left; border: 1px solid black;" src="{{url('/storage/student/profile_picture/'.$user->profile_picture)}}"/></a>
                                                    <h6 style="margin-left: 40px;">{{$user->name}}</h6>
                                                    <p style="margin-left: 50px;">{{$comment->comment}}</p>
                                            @endif
                                        </div> 
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div id="comment-form" class="col-md-12 col-md-offset-2" style = "margin-left:50px;">
                                    {{ Form::open(['route' =>['comments.store', $post->id, 'teacher'], 'method' => 'POST'])}}
                                    <div class="row">
                                        <div class="col-md-10">
                                            {{Form::label('comment', 'Comment:')}}
                                            {{Form::textarea('comment', '', ['class' => 'form-control', 'placeholder' => 'Put your comment here...', 'rows=3'])}}
                                        </div>
                                        <div class="col-md-10" style = "margin-top:5px;">
                                            {{Form::submit('Comment', ['class'=>"btn btn-success btn-block"])}}
                                            {!!Form::close()!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(Auth::user()->id == $post->user_id)
                                <br><a style="float:right;" href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
                                {!!Form::open(['action' => ['Auth\PostController@destroy', $post->id], 'method' => 'POST'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class'=>"btn btn-danger", 'float' => 'right', 'margin-left'=> '100px'])}}
                                {!!Form::close()!!}
                            @endif
                        </div><br><hr><br>
                    @endforeach
                @else
                    <p> No any post </p>
                @endif
            </div>
    </div>
@endsection