@extends('student.layouts.app')
@section('content')
    <?php use App\User;
        use App\Student; 
        function getLikes($id){
            $sql = "SELECT COUNT(*) FROM rating_infos 
                    WHERE post_id = $id AND rating_action='like'";
            $rs = mysqli_query(mysqli_connect('localhost', 'root', '0434', 'eduonline'), $sql);
            $result = mysqli_fetch_array($rs);
            return $result[0];
        }
        // Check if user already likes post or not
        function userLiked($post_id){
            $user_id=Auth::guard('student')->user()->id;
            $res=DB::select("select * from rating_infos where post_id=? and user_id=? and rating_action='like' and user_type='student'",[$post_id,$user_id]);
            return $res;
        }
    ?>
    <div class="container">
        <div class="row">
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
            </div>
        </div><br><br><hr><h1>Posts </h1><hr><br>
                @if(count($teacher->posts) > 0)
                    @foreach ($teacher->posts as $post)
                        <div class="well">
                            <a href="{{url('/storage/teacher/profile_picture/'.$post->user->profile_picture)}}"><img style="width:50px; height:50px; float:left; border: 1px solid black;" src="{{url('/storage/teacher/profile_picture/'.$post->user->profile_picture)}}"/></a>
                            <a href="{{url('show-teacher-profile/'.$post->user->id)}}"><h4 style="margin-left: 60px;">{{$post->user->name}}</h4></a>
                            <p style="margin-left: 70px; margin-top: -10px;">{{$post->user->user_name}}</p>
                            <h4 style="margin-left: 70px;">{{$post->title}}</h4>
                            <h5 style="margin-left: 90px;">{{$post->post_body}}</h5>                   
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
                                    <a href="{{url('student/view-all-files/'.$post->id)}}"><button style="margin-top:20px;" class="btn btn-primary">View all files</button></a>
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
                                    <a style="font-size:1.2em;" href="{{url('unlikes/'.$post->id)}}"><i class="fa fa-thumbs-up like-btn">&nbsp;<span style="color:blue;" class="l">Like</span></i></a>
                                <?php } else{?>
                                    <span class="likes"><?php echo getLikes($post->id); ?> people likes this</span><br>
                                    <a style="font-size:1.2em;" href="{{url('likes/'.$post->id)}}"><i class="fa fa-thumbs-o-up like-btn">&nbsp;<span style="color:black;" class="l">Like</span></i></a>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-md-offset-2" style = "margin-left:50px;">
                                    @foreach ($post->comments as $comment)
                                        <br>
                                        <div class="comment">
                                            @if($comment->user_type == 'teacher')
                                                <?php 
                                                    // $user = User::where('email', $comment->email)->firstOrFail();
                                                    $user = User::find($comment->user_id); ?>
                                                    <a href="{{url('/storage/teacher/profile_picture/'.$user->profile_picture)}}"><img style="width:30px; height:30px; float:left; border: 1px solid black;" src="{{url('/storage/teacher/profile_picture/'.$user->profile_picture)}}"/></a>
                                                    <a href="{{url('show-teacher-profile/'.$user->id)}}"><h6 style="margin-left: 40px;">{{$user->user_name}}</h6></a>
                                                    <p style="margin-left: 50px;">{{$comment->comment}}</p>
                                            @elseif($comment->user_type == 'student')
                                                <?php 
                                                    $user = Student::find($comment->user_id); ?>
                                                    <a href="{{url('/storage/student/profile_picture/'.$user->profile_picture)}}"><img style="width:30px; height:30px; float:left; border: 1px solid black;" src="{{url('/storage/student/profile_picture/'.$user->profile_picture)}}"/></a>
                                                    <a href="{{url('student/student-profile/'.$user->id)}}"><h6 style="margin-left: 40px;">{{$user->name}}</h6></a>
                                                    <p style="margin-left: 50px;">{{$comment->comment}}
                                                        @if(Auth::guard('student')->user()->id == $user->id)
                                                            &emsp;<a href="comment/edit/{{$comment->id}}">Edit</a>
                                                        @endif
                                                    </p>
                                            @endif
                                        </div> 
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div id="comment-form" class="col-md-12 col-md-offset-2" style = "margin-left:50px;">
                                    {{ Form::open(['route' =>['comments.store', $post->id, 'student'], 'method' => 'POST'])}}
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
                        </div><br><hr><br>
                    @endforeach
                @else
                    <p> No any post </p>
                @endif
            </div>
    </div>
@endsection