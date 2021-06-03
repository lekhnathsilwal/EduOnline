<?php

namespace Bitfumes\Multiauth\Http\Controllers;

use Bitfumes\Multiauth\Model\Admin;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Post;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role:super', ['only'=>'show']);
    }

    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->paginate(10);
        return view('multiauth::admin.home')->with('posts',$posts);
    }

    public function show()
    {
        $admins = Admin::where('id', '!=', 1)->get();

        return view('multiauth::admin.show', compact('admins'));
    }

    public function showChangePasswordForm()
    {
        return view('multiauth::admin.passwords.change');
    }

    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'oldPassword'   => 'required',
            'password'      => 'required|confirmed'
        ]);
        auth()->user()->update(['password' => bcrypt($data['password'])]);
        return redirect(route('admin.home'))->with('message', 'Your password is changed successfully');
    }
}
