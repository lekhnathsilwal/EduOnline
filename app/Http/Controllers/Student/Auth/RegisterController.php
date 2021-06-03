<?php

namespace App\Http\Controllers\Student\Auth;

use App\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Mail\VerifyStudent;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new admins as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/student';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('student.guest:student');
    }
    
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        if($request->hasFile('profile_picture')){
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
            $pfileNameToStore = 'nopp.jpg';
        }
        if($request->hasFile('student_card')){
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
            $scfileNameToStore = 'nopp.jpg';
        }
        event(new Registered($user = $this->create($request->all(), $pfileNameToStore, $scfileNameToStore)));

        $this->guard()->login($user);
        \Mail::to($user)->send(new VerifyStudent($user));

        return $this->registered($request, $user)
                        ?: redirect('/verifyStudent');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'faculty' => 'required', 'string', 'max:191',
            'program' => 'required', 'string', 'max:191',
            'college' => 'required', 'string', 'max:191',
            'email' => 'required|email|max:255|unique:students',
            'password' => 'required|min:6|confirmed',
            'profile_picture' => 'nullable', 'image', 'max:9000',
            'student_card' => 'required', 'image', 'max:9000',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Student
     */
    protected function create(array $data, $pfileNameToStore, $scfileNameToStore)
    {
        return Student::create([
            'name' => $data['name'],
            'faculty' => $data['faculty'],
            'program' => $data['program'],
            'college' => $data['college'],
            'profile_picture' => $pfileNameToStore,
            'student_card' => $scfileNameToStore,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('student.auth.register');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('student');
    }

}
