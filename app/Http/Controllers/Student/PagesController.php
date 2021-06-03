<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerifyStudent;
use App\Student;
use App\User;

class PagesController extends Controller
{
    public function home(){
        return view('student.pages.index');
    }
    public function showProfile($id){
        $student = Student::find($id);
        return view('student.pages.profile')->with('student', $student);
    }
    public function editProfile($id){
        $student = Student::find($id);
        return view('student.pages.editProfile')->with('student', $student);
    }
    public function updateProfile(Request $request,$id){
        $student = Student::find($id);
        $this->validate($request,[
            'name' => 'required|max:255',
            'faculty' => 'required', 'string', 'max:191',
            'program' => 'required', 'string', 'max:191',
            'college' => 'required', 'string', 'max:191',
            'email' => 'required|email|max:255',
            'profile_picture' => 'nullable', 'image', 'max:9000',
            'student_card' => 'nullable', 'image', 'max:9000',
        ]);
        if($request->hasFile('profile_picture')){
            //delete old profile picture
            if($student->profile_picture == "nopp.jpg"){}
            else{
                File::delete("storage/student/profile_picture/".$student->profile_picture);
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
            $path = $request->file('profile_picture')->storeAs('public/student/profile_picture',$pfileNameToStore);
        }else{
            $pfileNameToStore = $student->profile_picture;
        }
        if($request->hasFile('student_card')){
            //delete old profile picture
            if($student->student_card == "nopp.jpg"){}
            else{
                File::delete("storage/student/student_card/".$student->student_card);
            }
            //Get name of file with extension
            $scfileNameWithExt = $request->file('student_card')->getClientOriginalName();
            //Get just file name
            $scfileName = pathinfo($scfileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $scextension = $request->file('student_card')->getClientOriginalExtension();
            //Filename to store
            $scfileNameToStore = $scfileName.'_'.time().'.'.$scextension;
            //Upload image
            $scpath = $request->file('student_card')->storeAs('public/student/student_card',$scfileNameToStore);
        }else{
            $scfileNameToStore = $student->student_card;
        }
        $student->name = $request->input('name');
        $student->faculty = $request->input('faculty');
        $student->program = $request->input('program');
        $student->college = $request->input('college');
        $student->student_card = $scfileNameToStore;
        $student->profile_picture = $pfileNameToStore;
        if($student->email == $request->input('email')){
            $student->email = $request->input('email');
            $student->save();
        }
        else{
            $student->email = $request->input('email');
            $student->email_verified_at=NULL;
            $student->save();
            \Mail::to($student)->send(new VerifyStudent($student));
        }
        // $student->email = $request->input('email');
        // $student->save();
        return view('student.pages.profile')->with('student', $student);       
    }
    public function changePassword($id){
        $student = Student::find($id);
        return view('student/changePassword')->with('student', $student);
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
        $student = Student::find($id);
        $oldPassword = $student->password;
        if(Hash::check($password, $oldPassword)){
            $student->password = Hash::make($request->input('password'));
            $student->save();
            return redirect('student/')->with('success', 'Password changed');
        }else{
            return redirect('Student/')->with('error', 'Wrong password');
        }
    }
    public function search(Request $request){
        $search = $request->input('search');
        $teachers = User::where('name', 'LIKE', '%' .$search. '%' )
                            ->orwhere('email', 'LIKE', '%' .$search. '%' )
                            ->orwhere('user_name', 'LIKE', '%' .$search. '%')->get();
        return view('student.pages.search')->with('teachers', $teachers);
    }
    public function confirmVerification($user_id){
        $student = Student::find($user_id);
        $student->email_verified_at = date('Y-m-d H:i:s');
        $student->save();
        return redirect('/student');
    }
    public function resendVerification(){
        $user=Auth::guard('student')->user();
        \Mail::to($user)->send(new VerifyStudent($user));
        return redirect()->back();
    }
    public function changeStudentEmail(Request $request){
        $this->validate($request,[
            'email' => 'required|email'
        ]);
        $student_id=Auth::guard('student')->user()->id;
        $student=Student::find($student_id);
        if($student->email == $request->input('email')){
            $student->email = $request->input('email');
            $student->save();
        }
        else{
            $student->email = $request->input('email');
            $student->email_verified_at=NULL;
            $student->save();
            \Mail::to($student)->send(new VerifyStudent($student));
        }
        return redirect('/verifyStudent');
    }
}
