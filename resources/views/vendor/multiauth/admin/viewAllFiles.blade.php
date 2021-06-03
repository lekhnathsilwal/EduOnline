@extends('multiauth::layouts.app') 
@section('content')
<?php use App\User;
 use App\Student; ?>
    <div class="container">
                <div class="well">
                    <div class="post_head">
                        <a href="{{url('/storage/teacher/profile_picture/'.$post->user->profile_picture)}}"><img style="width:50px; border: 20px solid; border-color:white; height:50px; margin-left:7px; border-radius:25px; margin-top:7px; float:left; border: 1px solid black;" src="{{url('/storage/teacher/profile_picture/'.$post->user->profile_picture)}}"/></a>
                        <a href="{{url('admin/teacher-profile/'.$post->user->id)}}"><h4 style="margin-left: 70px; padding-top:5px; text-transform: capitalize;">{{$post->user->name}}</h4></a>
                    </div>
                    <p style="margin-left: 70px;">{{$post->user->email}}</p>
                    <h4 style="margin-left: 70px;">{{$post->title}}</h4>
                    <h5 style="margin-left: 90px;">{{$post->post_body}}</h5>                   
                    <div class="row">
                                <?php $fileFlag=0; ?>
                                @foreach ($post->postfiles as $file)
                                    @if($post->postfiles)
                                        @if($file->file_type=="mp4")
                                            <div class="col-md-12" style="margin-top:10px;">
                                                <video style="width:100%; float:left;" controls>
                                                    <source src="{{url('/storage/teacher/posts/'.$file->file_name)}}" type="video/mp4">
                                                </video>
                                            </div>
                                        @elseif($file->file_type=="jpg" || $file->file_type=="jpeg" || $file->file_type=="JPEG" || $file->file_type=="JPG" || $file->file_type=="gif")
                                            <div class="col-md-12" style="margin-top:10px;">
                                                <a href="{{url('/storage/teacher/posts/'.$file->file_name)}}"><img style="width:100%;" src="{{url('/storage/teacher/posts/'.$file->file_name)}}"></a>
                                            </div>
                                        @else
                                            <?php $fileFlag=1; ?>
                                        @endif
                                    @endif
                                @endforeach
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
                    <br>
                    @if($post->created_at == $post->updated_at)
                        <small style="margin-left: 60px;">Created at: {{$post->created_at}}&emsp;&emsp;</small>
                    @else
                        <small style="margin-left: 60px;">Updated at: {{$post->updated_at}}&emsp;&emsp;</small>
                    @endif
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 col-md-offset-2" style = "margin-left:50px;">
                        @foreach ($post->comments as $comment)
                        <br>
                           <div class="comment">
                               @if($comment->user_type == 'teacher')
                                    <?php 
                                        $user = User::find($comment->user_id); ?>
                                        <img style="width:30px; height:30px; float:left; border: 1px solid black;" src="{{url('/storage/teacher/profile_picture/'.$user->profile_picture)}}"/>
                                        <h6 style="margin-left: 40px;">{{$user->user_name}}</h6> 
                                        <p style="margin-left: 50px;">{{$comment->comment}}</p>
                                @elseif($comment->user_type == 'student')
                                    <?php 
                                    $user = Student::find($comment->user_id); ?>
                                    <img style="width:30px; height:30px; float:left; border: 1px solid black;" src="{{url('/storage/student/profile_picture/'.$user->profile_picture)}}"/>
                                    <h6 style="margin-left: 40px;">{{$user->name}}</h6>
                                    <p style="margin-left: 50px;">{{$comment->comment}}</p>
                                @endif
                            </div> 
                        @endforeach
                    </div>
                </div>
                <div class="form-group" style="margin-left:80px;">
                    <a onclick="return confirm('Are You Sure??')" href="{{url('admin/post-delete/'.$post->id)}}" class="btn btn-danger">Delete Post</a>
                </div>
                <br><hr><br>
    </div>
@endsection