<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UploadHelper;
use App\Http\Controllers\Controller;
 
use App\Models\Download;

 
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
 
class DownloadController extends Controller
{
    public function index()
    {
        $datas = Download::orderBy('id', 'desc')->get();
        return view('admin.downloads.index', compact('datas'));
    }

    public function create(){
        return view('admin.downloads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'pdf' => 'required',
            'image' => 'required',
            'slug' => 'required|alpha_dash|string|unique:downloads,deleted_at,NULL',
            
        ]);
        try {
            DB::beginTransaction();
            $download = new Download();
            
            $download->title = $request->title;
            $download->description = $request->description;

            $download->slug = $request->slug;
            $download->meta_title = $request->meta_title;
            $download->meta_keyword = $request->meta_keyword;
            $download->meta_description = $request->meta_description;


            if($request->hasfile('image')){
                $name = rand().'.'.$request->file('image')->extension();
                $request->file('image')->move(public_path('uploads/property'), $name);  
                $download->image = $name;
             }
             if($request->hasfile('pdf')){
                $name = rand().'.'.$request->file('pdf')->extension();
                $request->file('pdf')->move(public_path('uploads/property'), $name);  
                $download->pdf = $name;
             }
            $download->save();
          
         DB::commit();
            session()->flash('success', 'Downloads has been created successfully !!');
            return redirect()->route('downloads.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function edit($id)
    {
        $downloads = Download::find($id);
        if (is_null($downloads)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('downloads.index');
        }
        
        
        
         
        return view('admin.downloads.edit', compact('downloads'));
    }

    public function update(Request $request, $id)
    {
        $downloads = Download::find($id);

        if (is_null($downloads)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('downloads.index');
        }

        $request->validate([     
            'title' => 'required',
            'description' => 'required',
            'slug' => "required|alpha_dash|unique:downloads,slug,$id",
        ]);

        try {
            

            $downloads->title = $request->title;
          
            $downloads->description = $request->description;
            $download->slug = $request->slug;
            $download->meta_title = $request->meta_title;
            $download->meta_keyword = $request->meta_keyword;
            $download->meta_description = $request->meta_description;
            if($request->hasfile('image')){
                $name = rand().'.'.$request->file('image')->extension();
                $request->file('image')->move(public_path('uploads/property'), $name);  
                $downloads->image = $name;
             }

             if($request->hasfile('pdf')){
                $name = rand().'.'.$request->file('pdf')->extension();
                $request->file('pdf')->move(public_path('uploads/property'), $name);  
                $downloads->pdf = $name;
             }


           
             //file:///C:/Users/sss/Downloads/blog-classic-no-sidebar/shop-product-details.html
           
           //file:///C:/Users/sss/Downloads/blog-classic-no-sidebar/shortcode-styled-icons.html



            $downloads->save();


            
            
            
            

            
           

            
            session()->flash('success', 'Downloads has been updated successfully !!');
            return redirect()->route('downloads.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function destroy($id)
    {
        $fpo = Download::find($id);

        if (is_null($fpo)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('downloads.index');
        }
        // Remove Image
         

        

        // Delete fpo
        // $fpo->deleted_by = auth()->id();
        // $fpo->save();
        $fpo->delete();

        session()->flash('success', 'Testimonial has been deleted permanently !!');
        return redirect()->route('downloads.index');
    }
    
    
}
