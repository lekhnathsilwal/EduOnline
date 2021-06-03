<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Slide;

class SlideController extends Controller
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
        return view('vendor.multiauth.admin.addSlide');
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
            'description' => 'nullable',
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
            $path = $request->file('file')->storeAs('public/admin/slides',$fileNameToStore);
        }
        else{
            return redirect()->back()->with('error', 'File is required');
        }
        $slide = new Slide;
        $slide->heading = $request->input('heading');
        $slide->description = $request->input('description');
        $slide->file = $fileNameToStore;
        $slide->save();
        return redirect('admin/site')->with('success', 'Slide created successfully');
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
        $slide = Slide::find($id);
        return view('vendor.multiauth.admin.editSlide')->with('slide', $slide);
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
            'description' => 'nullable',
            'file' => 'nullable'
        ]);
        $slide = Slide::find($id);
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
            $path = $request->file('file')->storeAs('public/admin/slides',$fileNameToStore);
            //delete old image
            File::delete("storage/admin/slides/".$slide->file);
        }
        else{
            $fileNameToStore = $slide->file;
        }
        $slide->heading = $request->input('heading');
        $slide->description = $request->input('description');
        $slide->file = $fileNameToStore;
        $slide->save();
        return redirect('admin/site')->with('success', 'Slide updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slide::find($id); 
        File::delete("storage/admin/slides/".$slide->file);
        $slide->delete();
        return redirect('admin/site')->with('success', 'Slide deleted successfully');
    }
}
