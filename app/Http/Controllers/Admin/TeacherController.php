<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Commodity;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Teacher;
 

class TeacherController extends Controller
{
    public function index()
    {
        $datas = Teacher::orderBy('id', 'desc')->get();
        return view('admin.teacher.index',compact('datas'));
    }

    public function create()
    {
        $commodities = Commodity::all();
        return view('admin.teacher.create', compact('commodities'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'teacher_name'  => 'required|string',
                'subtitle'  => 'required',
                'description'  => 'required',
                'experiences'  => 'required',
                
                'email'  => 'required',
                'mobile'  => 'required',
            ],
             
        );
         
        $teacher = new Teacher();
        $teacher->teacher_name = $request->teacher_name;
        $teacher->subtitle = $request->subtitle;
        $teacher->description = $request->description;
        $teacher->experiences = $request->experiences;
        
        $teacher->email = $request->email;
        $teacher->mobile = $request->mobile;

        if($request->hasfile('image')){
            $name = rand().'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('uploads/property'), $name);  
            $teacher->image = $name;
         }
        $teacher->save();
        session()->flash('success', 'Teacher has been added successfully !!');
        return redirect()->route('teacher.index');
    }

    public function edit($id)
    {
        $teacher = Teacher::find($id);

        if (is_null($teacher)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('teacher.index');
        }
         
        return view('admin.teacher.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);

        if (is_null($teacher)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('teacher.index');
        }
        
        
        $request->validate(
            [
                'teacher_name'  => 'required|string',
                'subtitle'  => 'required',
                'description'  => 'required',
                'experiences'  => 'required',
                
                'email'  => 'required',
                'mobile'  => 'required',
            ],
             
        );
        
        $teacher->teacher_name = $request->teacher_name;
        $teacher->subtitle = $request->subtitle;
        $teacher->description = $request->description;
        $teacher->experiences = $request->experiences;
        
        $teacher->email = $request->email;
        $teacher->mobile = $request->mobile;

        if($request->hasfile('image')){
            $name = rand().'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('uploads/property'), $name);  
            $teacher->image = $name;
         }

        $teacher->save();

        session()->flash('success', 'Teacher has been updated successfully !!');
        return redirect()->route('teacher.index');
    }

    public function destroy($id)
    {
        $service = Teacher::find($id);

        if (is_null($service)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('teacher.index');
        }

         

        $service->deleted_by = auth()->id();
        $service->save();

        // Delete Service
        $service->delete();

        session()->flash('success', 'Teacher has been deleted permanently !!');
        return redirect()->route('teacher.index');
    }

     
}
