<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
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
    protected $redirectTo = '/posts';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            $path = $request->file('profile_picture')->storeAs('public/teacher/profile_picture',$pfileNameToStore);
        }else{
            $pfileNameToStore = 'nopp.jpg';
        }
        event(new Registered($user = $this->create($request->all(), $pfileNameToStore)));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:2', 'max:191'],
            'user_name' => ['required', 'string', 'min:3', 'max:191', 'unique:users'],
            'address' => ['required', 'string', 'min:3', 'max:191'],
            'contact' => ['required', 'string', 'min:9', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'engaged_college' => ['required', 'string', 'max:191'],
            'teaching_faculty' => ['required', 'string', 'max:191'],
            'teaching_program' => ['required', 'string', 'max:191'],
            'citizenship' => ['required', 'image', 'max:9000'],
            'teacher_card' => ['required', 'image', 'max:9000'],
            'profile_picture' => ['nullable', 'image', 'max:9000'],
            'verification' => ['required', 'string', 'max:191'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data, $pfileNameToStore)
    {
        //Handle File Upload
        if($data['citizenship']){
            //Get name of file with extension
            $fileNameWithExt = $data['citizenship']->getClientOriginalName();
            //Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $data['citizenship']->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload image
            $path = $data['citizenship']->storeAs('public/teacher/citizenship',$fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }
        if($data['teacher_card']){
            //Get name of file with extension
            $cFileNameWithExt = $data['teacher_card']->getClientOriginalName();
            //Get just file name
            $cFileName = pathinfo($cFileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $cExtension = $data['teacher_card']->getClientOriginalExtension();
            //Filename to store
            $cFileNameToStore = $cFileName.'_'.time().'.'.$cExtension;
            //Upload image
            $path = $data['teacher_card']->storeAs('public/teacher/teacher_card',$cFileNameToStore);
        }else{
            $cFileNameToStore = 'noimage.jpg';
        }
        return User::create([
            'name' => $data['name'],
            'user_name' => $data['user_name'],
            'address' => $data['address'],
            'contact' => $data['contact'],
            'email' => $data['email'],
            'engaged_college' => $data['engaged_college'],
            'teaching_faculty' => $data['teaching_faculty'],
            'teaching_program' => $data['teaching_program'],
            'citizenship' => $fileNameToStore,
            'teacher_card' => $cFileNameToStore,
            'profile_picture' => $pfileNameToStore,
            'available_balance' => 0.00,
            'verification' => $data['verification'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
