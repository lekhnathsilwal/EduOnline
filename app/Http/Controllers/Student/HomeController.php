<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;

class HomeController extends Controller
{

    protected $redirectTo = '/student/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('student.auth:student');
    }

    /**
     * Show the Student dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $posts = Post::orderBy('updated_at', 'desc')->paginate(10);
        return view('student.home')->with('posts',$posts);
    }
    public function showTeacherProfile($id){
        $teacher = User::find($id);
        return view('student/pages/teacherProfile')->with('teacher', $teacher);
    }
    public function viewAllFiles($post_id)
    {
        $post = Post::find($post_id);
        return view('student.pages.viewAllFiles')->with('post', $post);
    }
}