<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Comment;
use App\Post;
use App\Student;
use App\User;
use App\Rating_info;
use DB;
class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id,$user_type)
    {
        $this->validate($request,[
            'comment' => 'required|max:2000'
        ]);
        $post = Post::find($post_id);
        $comment = new Comment();
        $comment->comment = $request->input('comment');
        if($user_type == 'student'){
            $comment->user_type = 'student';
            $comment->user_id = Auth::guard('student')->user()->id;
            $comment->post()->associate($post);
            $comment->save();
            return redirect('/student');
        }elseif($user_type == 'teacher'){
            $comment->user_type = 'teacher';
            $comment->user_id = Auth::user()->id;
            $comment->post()->associate($post);
            $comment->save();
            return redirect('/posts');
        }else {
            return redirect('/posts')->with('error', 'You can not comment on this post');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($comment_id)
    {
        $comment = Comment::find($comment_id);
        if($comment->user_type == 'teacher'){
            return view('teacher.post.editTeacherComment')->with('comment', $comment);
        }
        elseif($comment->user_type == 'student'){
            return view('teacher.post.editStudentComment')->with('comment', $comment);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $comment_id)
    {
        $this->validate($request,[
            'comment' => 'required|max:2000'
        ]);
        $comment = Comment::find($comment_id);
        $post = Post::find($comment->post_id);
        $comment->comment = $request->input('comment');
        if($comment->user_type == 'student'){
            $comment->user_type = 'student';
            $comment->user_id = Auth::guard('student')->user()->id;
            $comment->post()->associate($post);
            $comment->save();
            return redirect('/student');
        }elseif($comment->user_type == 'teacher'){
            $comment->user_type = 'teacher';
            $comment->user_id = Auth::user()->id;
            $comment->post()->associate($post);
            $comment->save();
            return redirect('/posts');
        }else {
            return redirect('/')->with('error', 'You can not comment on this post');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($comment_id)
    {
        $comment = Comment::find($comment_id);
        if($comment->user_type == 'teacher'){
            $comment->delete();
            return redirect('/posts')->with('success', 'Comment deleted sucessfully');
        }
        elseif($comment->user_type == 'student'){
            $comment->delete();
            return redirect('/student')->with('success', 'Comment deleted sucessfully');
        }
    
    }
    public function likes($post_id)
    {
        $rating_info = new Rating_info();
        $rating_info->user_id=Auth::guard('student')->user()->id;
        $rating_info->post_id=$post_id;
        $rating_info->user_type="student";
        $rating_info->rating_action="like";
        $rating_info->save();
        return Redirect::to('/student');
        // $user_id=Auth::guard('student')->user()->id;
        // $user_type="student";
        // $rating_action="like";
        // $created_at=date('Y-m-d H:i:s');
        // $updated_at=date('Y-m-d H:i:s');
        // DB::insert("insert into rating_infos(user_id,post_id,user_type,rating_action,created_at,updated_at) values(?,?,?,?,?,?)",[$user_id,$post_id,$user_type,$rating_action,$created_at,$updated_at]);
        // return Redirect::to('/student');
    }
    public function unlikes($post_id)
    {
        $user_id=Auth::guard('student')->user()->id;
        $rating_info = Rating_info::where('post_id', $post_id)->where('user_type','student')->where('user_id',$user_id)->delete();
        return Redirect::to('/student');
        //DB::update("update rating_infos set rating_action='unlike' where post_id=? and user_id=?",[$post_id,$user_id]);
    }
    public function teacher_likes($post_id)
    {
        $rating_info = new Rating_info();
        $rating_info->user_id=Auth::user()->id;
        $rating_info->post_id=$post_id;
        $rating_info->user_type="teacher";
        $rating_info->rating_action="like";
        $rating_info->save();
        return Redirect::to('/posts');
    }
    public function teacher_unlikes($post_id)
    {
        $user_id=Auth::user()->id;
        $rating_info = Rating_info::where('post_id', $post_id)->where('user_type','teacher')->where('user_id',$user_id)->delete();
        return Redirect::to('/posts');
    }
}