<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Slide;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        return view('vendor.multiauth.admin.site');
    }
    public function addSlide()
    {
        return view('vendor.multiauth.admin.addSlide');
    }
    public function createSlide(Request $request)
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
    public function editSlide($id)
    {
        $slide = Slide::find($id);
        return view('vendor.multiauth.admin.editSlide')->with('slide', $slide);
    }
    public function updateSlide(Request $request, $id)
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
    public function destroySlide($id)
    {
        $slide = Slide::find($id); 
        File::delete("storage/admin/slides/".$slide->file);
        $slide->delete();
        return redirect('admin/site')->with('success', 'Slide deleted successfully');
    }
}
