<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File; 
use App\Post;
use App\User;
use App\Postfile;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => 'index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->paginate(10);
        return view('teacher.post.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'post_body' => 'required',
            'file_name' => 'nullable'
        ]);
        $user = User::find(auth()->user()->id);
        $post = new Post;
        $post->title = $request->input('title');
        $post->post_body = $request->input('post_body');
        $post->total_likes = 0;
        $post->payed_upto = 0;
        $post->payable = 0.00;
        $post->user()->associate($user);
        $post->save();
        if($request->hasFile('file_name')){
            $p = Post::find($post->id);
            for($i=0; $i < count($request->file('file_name')); $i++)
            {
                $f = new Postfile;
                $file = $request->file('file_name')[$i];
                $file_name = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $file_size = ($file->getClientSize())/(1024*1024);
                $path = 'public/teacher/posts';
                $fileNameToStore = $file_name.'_'.time().'.'.$extension;
                $mpath = $request->file('file_name')[$i]->storeAs($path, $fileNameToStore);
                $f->file_name = $fileNameToStore;
                $f->file_type = $extension;
                $f->file_size = $file_size;
                $f->post()->associate($p);             
                $f->save();
            }
        }
        else{
        }
        return redirect('/posts')->with('success', 'Post created successfully');
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
    public function edit($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized paze');
        }
        return view('teacher.post.edit')->with('post', $post);
    }
    public function deleteFile($id)
    {
        $postFile = Postfile::find($id);
        File::delete("storage/teacher/posts/".$postFile->file_name);
        $postFile->delete();
        return redirect()->back()->with('success', 'File deleted successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'post_body' => 'required',
            'file_name' => 'nullable'
        ]);
        $user = User::find(auth()->user()->id);
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->post_body = $request->input('post_body');
        $post->total_likes = $post->total_likes;
        $post->payed_upto = $post->payed_upto;
        $post->payable = $post->payable;
        $post->user()->associate($user);
        $post->save();
        if($request->hasFile('file_name')){
            $p = Post::find($post->id);
            for($i=0; $i < count($request->file('file_name')); $i++)
            {
                $f = new Postfile;
                $file = $request->file('file_name')[$i];
                $file_name = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $file_size = ($file->getClientSize())/(1024*1024);
                $path = 'public/teacher/posts';
                $fileNameToStore = $file_name.'_'.time().'.'.$extension;
                $mpath = $request->file('file_name')[$i]->storeAs($path, $fileNameToStore);
                $f->file_name = $fileNameToStore;
                $f->file_type = $extension;
                $f->file_size = $file_size;
                $f->post()->associate($p);             
                $f->save();
            }
        }
        else{
        }
        return redirect('/posts')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized paze');
        }
        if($post->postfiles){
            $files = $post->postfiles;
            foreach($files as $fls){
                File::delete("storage/teacher/posts/".$fls->file_name);
                $fls->delete();
            }
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post deleted sucessfully');
    }
}
