<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\User;
use App\Post;

class TeacherController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function showProfile($id){
        $teacher = User::find($id);
        return view('teacher/profile')->with('teacher', $teacher);
    }
    public function editProfile($id){
        $teacher = User::find($id);
        return view('teacher/editProfile')->with('teacher', $teacher);
    }
    public function updateProfile(Request $request){
        $id = $request->input('id');
        $teacher = User::find($id);
        if($request->hasFile('profile_picture')){
            //delete old profile picture
            if($teacher->profile_picture == "nopp.jpg"){}
            else{
                File::delete("storage/teacher/profile_picture/".$teacher->profile_picture);
            }
            //Get name of file with extension
            $pfileNameWithExt = $request->file('profile_picture')->getClientOriginalName();
            //Get just file name
            $pfileName = pathinfo($pfileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $pextension = $request->file('profile_picture')->getClientOriginalExtension();
            //Filename to store
            $pfileNameToStore = $pfileName.'_'.time().'.'.$pextension;
            //Upload image
            $path = $request->file('profile_picture')->storeAs('public/teacher/profile_picture',$pfileNameToStore);
        }else{
            $pfileNameToStore = $teacher->profile_picture;
        }
        if($request->hasFile('citizenship')){
            //delete old citizenship
            File::delete("storage/teacher/citizenship/".$teacher->citizenship);
            //Get name of file with extension
            $fileNameWithExt = $request->file('citizenship')->getClientOriginalName();
            //Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('citizenship')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload image
            $path = $request->file('citizenship')->storeAs('public/teacher/citizenship',$fileNameToStore);
        }else{
            $fileNameToStore = $teacher->citizenship;
        }
        if($request->hasFile('teacher_card')){
            //delete old teacher card
            File::delete("storage/teacher/teacher_card/".$teacher->teacher_card);
            //Get name of file with extension
            $cFileNameWithExt = $request->file('teacher_card')->getClientOriginalName();
            //Get just file name
            $cFileName = pathinfo($cFileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $cExtension = $request->file('teacher_card')->getClientOriginalExtension();
            //Filename to store
            $cFileNameToStore = $cFileName.'_'.time().'.'.$cExtension;
            //Upload image
            $path = $request->file('teacher_card')->storeAs('public/teacher/teacher_card',$cFileNameToStore);
        }else{
            $cFileNameToStore = $teacher->teacher_card;
        }
        $teacher->name = $request->input('name');
        $teacher->user_name = $request->input('user_name');
        $teacher->address = $request->input('address');
        $teacher->contact = $request->input('contact');
        if($teacher->email == $request->input('email')){
            $teacher->email = $request->input('email');
        }
        else{
            $teacher->email = $request->input('email');
            $teacher->email_verified_at=NULL;
        }
        $teacher->verification = $request->input('verification');
        $teacher->engaged_college = $request->input('engaged_college');
        $teacher->teaching_faculty = $request->input('teaching_faculty');
        $teacher->teaching_program = $request->input('teaching_program');
        $teacher->citizenship = $fileNameToStore;
        $teacher->teacher_card = $cFileNameToStore;
        $teacher->profile_picture = $pfileNameToStore;
        $teacher->available_balance = $teacher->available_balance;
        $teacher->save();
        return view('teacher/profile')->with('teacher', $teacher);
    }
    public function changePassword($id){
        $teacher = User::find($id);
        return view('teacher/changePassword')->with('teacher', $teacher);
    }
    public function updatePassword(Request $request, $id){
        // $data = $request->validate([
        //     'oldPassword'   => 'required',
        //     'password'      => 'required|confirmed'
        // ]);
        $this->validate($request,[
            'oldPassword'   => 'required',
            'password'      => 'required|confirmed'
        ]);
        $password = $request->input('oldPassword');
        $teacher = User::find($id);
        $oldPassword = $teacher->password;
        if(Hash::check($password, $oldPassword)){
            $teacher->password = Hash::make($request->input('password'));
            $teacher->save();
            return redirect('/posts')->with('success', 'Password changed');
        }else{
            return redirect('/posts')->with('error', 'Wrong password');
        }
    }
    public function search(Request $request){
        $search = $request->input('search');
        $teachers = User::where('name', 'LIKE', '%' .$search. '%' )
                            ->orwhere('email', 'LIKE', '%' .$search. '%' )
                            ->orwhere('user_name', 'LIKE', '%' .$search. '%')->get();
        return view('teacher.search')->with('teachers', $teachers);
    }
    public function viewAllFiles($post_id)
    {
        $post = Post::find($post_id);
        return view('teacher.post.viewAllFiles')->with('post', $post);
    }
}
