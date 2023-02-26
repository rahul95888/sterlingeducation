<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Commodity;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

 
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    
    public function index()
    {
        $datas  = News::orderBy('id', 'desc')->get();
        return view('admin.news.index',compact('datas'));
    }

    public function create()
    {
        
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|string',
            'content'  => 'required',
            'image'  => 'nullable|image',
            'slug' => 'required|alpha_dash|string|unique:news,deleted_at,NULL',
        ]);
        

        try {
            

            
            $news = new News();
            $news->title = $request->title;
            $news->content = $request->content;
            $news->slug = $request->slug;
            $news->meta_title = $request->meta_title;
            $news->meta_keyword = $request->meta_keyword;
            $news->meta_description = $request->meta_description;

            if (!is_null($request->image)) {
                $imageName = time().'.'.$request->file('image')->extension();
                request()->image->move(public_path('uploads/category'), $imageName);
                $news->image  =   $imageName;

            }
            $news->save();

            
            session()->flash('success', 'News has been created successfully !!');
            return redirect()->route('news.index');

            
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            
            return back();
        }
    }

    public function edit($id)
    {
        $news = News::find($id);

        if (is_null($news)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('news.index');
        }
        
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $news = News::find($id);

        if (is_null($news)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('news.index');
        }

        $request->validate([
            'title'  => 'required|string',
            'slug' => "required|alpha_dash|unique:news,slug,$id",
            'content'  => 'required|string',
            'image'  => 'nullable|image'
        ]);
        
        

        try {
            DB::beginTransaction();

            $news_uid = $news->news_uid;
            $news->title = $request->title;
            $news->content = $request->content;
            $news->slug = $request->slug;
            $news->meta_title = $request->meta_title;
            $news->meta_keyword = $request->meta_keyword;
            $news->meta_description = $request->meta_description;
            
            if (!is_null($request->image)) {
                $imageName = time().'.'.$request->file('image')->extension();
                request()->image->move(public_path('uploads/category'), $imageName);
                $news->image  =   $imageName;

            }
            $news->save();
            DB::commit();
            session()->flash('success', 'News has been updated successfully !!');
            return redirect()->route('news.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function destroy($id)
    {
        $news = News::find($id);

        if (is_null($news)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('news.index');
        }
        // Remove Image
        UploadHelper::deleteFile('assets/uploaded_images/news/' . $news->image);

        $news->deleted_by = auth()->id();
        $news->save();

        // Delete News
        $news->delete();

        session()->flash('success', 'News has been deleted permanently !!');
        return redirect()->route('news.index');
    }
}
