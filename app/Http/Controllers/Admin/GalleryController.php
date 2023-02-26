<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Commodity;
use App\Models\Gallery;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{
    public function index()
    {
        $datas = Gallery::orderBy('id', 'desc')->get();
        return view('admin.gallery.index',compact('datas'));
    }

    public function create()
    {
       
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title'  => 'required|string', 
               
                'image'  => 'nullable|file|mimes:jpg,png,jpeg,bmp',
            ],
           
        );
         
         
        
        try {
            DB::beginTransaction();

           

            $gallery = new Gallery();
            
            $gallery->title = $request->title;
            if (!is_null($request->image)) {
                $imageName = time().'.'.$request->file('image')->extension();
                request()->image->move(public_path('uploads/property'), $imageName);
                $gallery->image  =   $imageName;

            }
            $gallery->save();
            DB::commit();
            session()->flash('success', 'Slider has been created successfully !!');
            return redirect()->route('gallery.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function edit($id)
    {
        $gallery = Gallery::find($id);

        if (is_null($gallery)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('gallery.index');
        }
        $sections = Section::all();
        $commodities = Commodity::all();
        return view('admin.gallery.edit', compact('gallery', 'commodities', 'sections'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::find($id);

        if (is_null($gallery)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('gallery.index');
        }

        $request->validate(
            [
                'title'  => 'required|string',
              
                'image'  => 'nullable|image',
            ],
             
        );
         
        try {
            DB::beginTransaction();
            $gallery->title = $request->title;
          
             
            if($request->hasfile('image')){
                $name = rand().'.'.$request->file('image')->extension();
                $request->file('image')->move(public_path('uploads/property'), $name);  
                $gallery->image = $name;
             }
            $gallery->save();
            DB::commit();
            session()->flash('success', 'Slider has been updated successfully !!');
            return redirect()->route('gallery.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);

        if (is_null($gallery)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('gallery.index');
        }
        // Remove Image
        UploadHelper::deleteFile('assets/uploaded_images/gallery/' . $gallery->image);

        $gallery->deleted_by = auth()->id();
        $gallery->save();

        // Delete Gallery
        $gallery->delete();

        session()->flash('success', 'gallery has been deleted permanently !!');
        return redirect()->route('gallery.index');
    }
}
