<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoLesson;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VideoLessonController extends Controller
{
    public function index()
    {
        $data = VideoLesson::get();
        return view('admin.videolesson.index',compact('data'));
    }

    public function create()
    {
        return view('admin.videolesson.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required",
            "amount" => "required",
            "url" => "required",
            "description" => "required",
            'slug' => 'required|alpha_dash|string|unique:videolesson,deleted_at,NULL',
        ]);

        

        $mocktest = new VideoLesson();
     
        $mocktest->title = $request->title;
        $mocktest->description = $request->description ?? null;
        $mocktest->amount = $request->amount ?? null;
        $mocktest->url = $request->url ?? null;


        $mocktest->slug = $request->slug;
        $mocktest->meta_title = $request->meta_title;
        $mocktest->meta_keyword = $request->meta_keyword;
        $mocktest->meta_description = $request->meta_description;


        
        if($request->hasfile('thumb')){
            $name = rand().'.'.$request->file('thumb')->extension();
            $request->file('thumb')->move(public_path('uploads/property'), $name);  
            $mocktest->thumb = $name;
         }


        $mocktest->save();

        session()->flash('success', 'Video Lesson has been created successfully !!');
        return redirect()->route('videolesson.index');
    }

    public function edit($id)
    {
        $mocktest = VideoLesson::find($id);

        if (is_null($mocktest)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('videolesson.index');
        }

        return view('admin.videolesson.edit', compact('mocktest'));
    }

    public function update(Request $request, $id)
    {
        $mocktest = VideoLesson::find($id);

        if (is_null($mocktest)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('videolesson.index');
        }

        $request->validate([
            "title" => "required",
            "amount" => "required",
            "url" => "required",
            "description" => "required",
            'slug' => "required|alpha_dash|unique:videolesson,slug,$id",
        ]);


        $mocktest->title = $request->title;
        $mocktest->description = $request->description ?? null;
        $mocktest->amount = $request->amount ?? null;
        $mocktest->url = $request->url ?? null;


        $mocktest->slug = $request->slug;
        $mocktest->meta_title = $request->meta_title;
        $mocktest->meta_keyword = $request->meta_keyword;
        $mocktest->meta_description = $request->meta_description;

        if($request->hasfile('thumb')){
            $name = rand().'.'.$request->file('thumb')->extension();
            $request->file('thumb')->move(public_path('uploads/property'), $name);  
            $mocktest->thumb = $name;
         }


        $mocktest->save();

        session()->flash('success', 'Video Lesson  has been updated successfully !!');
        return redirect()->route('videolesson.index');
    }

    public function destroy($id)
    {
        $mocktest = VideoLesson::find($id);

        if (is_null($mocktest)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('videolesson.index');
        }

        $mocktest->deleted_by = auth()->id();
        $mocktest->save();

        // Delete Equipment
        $mocktest->delete();

        session()->flash('success', 'Equipment has been deleted permanently !!');
        return redirect()->route('videolesson.index');
    }
}
