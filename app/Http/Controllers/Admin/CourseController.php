<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Commodity;
use App\Models\Country;
use App\Models\District;
use App\Models\Education;
use App\Models\Pincode;
use App\Models\City;
use App\Models\ProcessCapability;
use App\Models\ProcessMethod;
use App\Models\Course;

use App\Models\State;
use App\Models\SubDistrict;
use App\Models\Village;
use App\Models\WarehouseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Gallery;
class CourseController extends Controller
{
    public function index()
    {
        $datas = Course::orderBy('id', 'desc')->get();
        return view('admin.courses.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'title' => 'required',
            'type' => 'required',
            'description' => 'required',
            'syllabus' => 'required',
            'pattern' => 'required',
            'criteria' => 'required',
            'image' => 'required',
            'slug' => 'required|alpha_dash|string|unique:courses,deleted_at,NULL',
            
        ]);
        try {
            DB::beginTransaction();
            $processor = new Course();
            $processor->slug = $request->slug;
            $processor->title = $request->title;
            $processor->type = $request->type;
            $processor->description = $request->description;
            $processor->syllabus = $request->syllabus;
            $processor->pattern = $request->pattern;
            $processor->criteria = $request->criteria;
            $processor->price = $request->amount;

            $processor->meta_title = $request->meta_title;
            $processor->meta_keyword = $request->meta_keyword;
            $processor->meta_description = $request->meta_description;
           
            

            if($request->hasfile('image')){
                $name = rand().'.'.$request->file('image')->extension();
                $request->file('image')->move(public_path('uploads/property'), $name);  
                $processor->image = $name;
             }
            $processor->save();
          
         DB::commit();
            session()->flash('success', 'Course has been created successfully !!');
            return redirect()->route('course.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function edit($id)
    {
        $course = Course::find($id);
        if (is_null($course)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('course.index');
        }
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if (is_null($course)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('processors.index');
        }

        $request->validate([
             
            'title' => 'required',
            'type' => 'required',
            'description' => 'required',
            'syllabus' => 'required',
            'pattern' => 'required',
            'criteria' => 'required',
            'slug' => "required|alpha_dash|unique:courses,slug,$id",
            
            
        ]);

        try {
            DB::beginTransaction();

            $course->title = $request->title;
            $course->slug = $request->slug;
            $course->type = $request->type;
            $course->description = $request->description;
            $course->syllabus = $request->syllabus;
            $course->pattern = $request->pattern;
            $course->criteria = $request->criteria;
            $course->price = $request->amount;

            $course->meta_title = $request->meta_title;
            $course->meta_keyword = $request->meta_keyword;
            $course->meta_description = $request->meta_description;


            if($request->hasfile('image')){
                $name = rand().'.'.$request->file('image')->extension();
                $request->file('image')->move(public_path('uploads/property'), $name);  
                $course->image = $name;
             }
            $course->save();


            
            
            
            

            
           

            DB::commit();
            session()->flash('success', 'Course has been updated successfully !!');
            return redirect()->route('course.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function destroy($id)
    {
        $fpo = Course::find($id);

        if (is_null($fpo)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('downloads.index');
        }
        // Remove Image
         

        

       
        $fpo->delete();

        session()->flash('success', 'Course has been deleted permanently !!');
        return back();
    }
    

    
    
}
