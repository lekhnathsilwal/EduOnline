<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\User;
use App\Post;
use App\Comment;
use App\Payment_request;

class TeacherHandler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //shows teacher signup requests
    public function showRequest()
    {
        $users = User::all();
        return view('vendor.multiauth.admin.showRequest')->with('users', $users);
    }
    public function showTeachers()
    {
        $users = User::all();
        return view('vendor.multiauth.admin.showTeachers')->with('users', $users);
    }
    public function showTeacherProfile($id)
    {
        $teacher = User::find($id);
        return view('vendor.multiauth.admin.showTeacherProfile')->with('teacher', $teacher);
    }
    public function confirmTeacher($id)
    {
        $teacher = User::find($id);
        $teacher->verification = "done";
        $teacher->save();
        $users = User::all();
        return view('vendor.multiauth.admin.showRequest')->with('users', $users);
    }
    public function deleteTeacher($id)
    {
        $teacher = User::find($id);
        $comments = Comment::where('user_id', $teacher->id)->where('user_type', 'teacher')->get();
        if($comments){
            foreach($comments as $comment){
                $comment->delete();
            }
        }
        File::delete("storage/teacher/citizenship/".$teacher->citizenship);
        File::delete("storage/teacher/teacher_card/".$teacher->teacher_card);
        if($teacher->profile_picture == 'nopp.jpg'){}else{
            File::delete("storage/teacher/profile_picture/".$teacher->profile_picture);
        }
        if($teacher->verification == 'done'){
            if($teacher->posts){
                $teacher_posts = $teacher->posts;
                foreach ($teacher_posts as $teacher_post){
                    if($teacher_post->postfiles){
                        $files = $teacher_post->postfiles;
                        foreach($files as $fls){
                            File::delete("storage/teacher/posts/".$fls->file_name);
                            $fls->delete();
                        }
                    }
                    $teacher_post->delete();
                }
            }
        }
        $teacher->delete();
        $users = User::all();
        return view('vendor.multiauth.admin.showRequest')->with('users', $users);
    }
    public function deletePosts($id)
    {
        $post = Post::find($id);
        if($post->postfiles){
            $files = $post->postfiles;
            foreach($files as $fls){
                File::delete("storage/teacher/posts/".$fls->file_name);
                $fls->delete();
            }
        }
        $post->delete();
        return redirect(route('admin.home'))->with('success', 'Post deleted sucessfully');
    }
    public function searchTeacher(Request $request){
        $search = $request->input('search');
        $teachers = User::where('name', 'LIKE', '%' .$search. '%' )
                            ->orwhere('email', 'LIKE', '%' .$search. '%' )
                            ->orwhere('user_name', 'LIKE', '%' .$search. '%')
                            ->orWhereHas('posts', function($q) use($search){
                                return $q->where('title', 'LIKE', '%' .$search. '%' );
                            })->get();
        return view('vendor.multiauth.admin.search-teacher')->with('teachers', $teachers);
    }
    public function viewAllFiles($post_id)
    {
        $post = Post::find($post_id);
        return view('vendor.multiauth.admin.viewAllFiles')->with('post', $post);
    }
    public function mostLikedPosts()
    {
        $posts = Post::orderBy('updated_at', 'desc')->paginate(10);
        return view('vendor.multiauth.admin.mostLikedPosts')->with('posts',$posts);
    }
    public function showPaymentRequest()
    {
        $payments = Payment_request::orderBy('updated_at', 'desc')->paginate(10);
        return view('vendor.multiauth.admin.showPaymentRequest')->with('payments', $payments);
    }
    public function Pay($id)
    {
        $payment = Payment_request::find($id);
        $payment->delete();
        $payments = Payment_request::orderBy('updated_at', 'desc')->paginate(10);
        return view('vendor.multiauth.admin.showPaymentRequest')->with('payments', $payments);
    }
}