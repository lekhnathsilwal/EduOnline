<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Student;
use App\Comment;

class StudentHandler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function showStudents()
    {
        $students = Student::all();
        return view('vendor.multiauth.admin.showStudents')->with('students', $students);
    }
    public function showStudentProfile($id)
    {
        $student = Student::find($id);
        return view('vendor.multiauth.admin.showStudentProfile')->with('student', $student);
    }
    public function searchStudent(Request $request){
        $search = $request->input('search');
        $students = Student::where('name', 'LIKE', '%' .$search. '%' )
                            ->orwhere('email', 'LIKE', '%' .$search. '%' )->get();
        return view('vendor.multiauth.admin.search-student')->with('students', $students);
    }
    public function deleteStudent($id){
        $student = Student::find($id);
        $comments = Comment::where('user_id', $student->id)->where('user_type', 'student')->get();
        if($comments){
            foreach($comments as $comment){
                $comment->delete();
            }
        }
        if($student->profile_picture=='nopp.jpg'){}else{
            File::delete("storage\student\profile_picture/".$student->profile_picture);
        }
        $student->delete();
        $students = Student::all();
        return view('vendor.multiauth.admin.showStudents')->with('students', $students);
    }
    
}
