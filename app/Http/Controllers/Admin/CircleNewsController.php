<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\CircleNews;

class CircleNewsController extends Controller
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
        return view('vendor.multiauth.admin.addCircleNews');
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
            $path = $request->file('file')->storeAs('public/admin/circle_news',$fileNameToStore);
        }
        else{
            return redirect()->back()->with('error', 'File is required');
        }
        $news = new CircleNews;
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
        $circleNews = CircleNews::find($id);
        return view('vendor.multiauth.admin.showNews')->with('circleNews', $circleNews);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $circleNews = CircleNews::find($id);
        return view('vendor.multiauth.admin.editCircleNews')->with('circleNews', $circleNews);
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
        $circleNews = CircleNews::find($id);
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
            $path = $request->file('file')->storeAs('public/admin/circle_news',$fileNameToStore);
            //delete old image
            File::delete("storage/admin/circle_news/".$circleNews->file);
        }
        else{
            $fileNameToStore = $circleNews->file;
        }
        $circleNews->heading = $request->input('heading');
        $circleNews->description = $request->input('description');
        $circleNews->file = $fileNameToStore;
        $circleNews->save();
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
        $circleNews = CircleNews::find($id); 
        File::delete("storage/admin/circle_news/".$circleNews->file);
        $circleNews->delete();
        return redirect('admin/site')->with('success', 'News deleted successfully');
    }
}
