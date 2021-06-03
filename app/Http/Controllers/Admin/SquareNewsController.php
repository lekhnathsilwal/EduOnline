<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\SquareNews;

class SquareNewsController extends Controller
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
        return view('vendor.multiauth.admin.addSquareNews');
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
            'heading' => 'required',
            'description' => 'required',
            'file' => 'required'
        ]);
        if($request->hasFile('file')){
            //Get name of file with extension
            $fileNameWithExt = $request->file('file')->getClientOriginalName();
            //Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload image
            $path = $request->file('file')->storeAs('public/admin/square_news',$fileNameToStore);
        }
        else{
            return redirect()->back()->with('error', 'File is required');
        }
        $news = new SquareNews;
        $news->heading = $request->input('heading');
        $news->description = $request->input('description');
        $news->file = $fileNameToStore;
        $news->save();
        return redirect('admin/site')->with('success', 'Circle News Added successfully');
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
        $squareNews = SquareNews::find($id);
        return view('vendor.multiauth.admin.editSquareNews')->with('squareNews', $squareNews);
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
            'heading' => 'required',
            'description' => 'required',
            'file' => 'nullable'
        ]);
        $squareNews = SquareNews::find($id);
        if($request->hasFile('file')){
            //Get name of file with extension
            $fileNameWithExt = $request->file('file')->getClientOriginalName();
            //Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload image
            $path = $request->file('file')->storeAs('public/admin/square_news',$fileNameToStore);
            //delete old image
            File::delete("storage/admin/square_news/".$squareNews->file);
        }
        else{
            $fileNameToStore = $squareNews->file;
        }
        $squareNews->heading = $request->input('heading');
        $squareNews->description = $request->input('description');
        $squareNews->file = $fileNameToStore;
        $squareNews->save();
        return redirect('admin/site')->with('success', 'News updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $squareNews = SquareNews::find($id); 
        File::delete("storage/admin/square_news/".$squareNews->file);
        $squareNews->delete();
        return redirect('admin/site')->with('success', 'News deleted successfully');
    }
}
