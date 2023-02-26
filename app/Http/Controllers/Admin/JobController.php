<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Commodity;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Job;
 

class JobController extends Controller
{
    public function index()
    {
        $datas = Job::orderBy('id', 'desc')->get();
        return view('admin.job.index',compact('datas'));
    }

    public function create()
    {
        $commodities = Commodity::all();
        return view('admin.job.create', compact('commodities'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title'  => 'required|string',
                'location'  => 'required',
                'description'  => 'required',
                'salary'  => 'required',
                'image'  => 'nullable|file|mimes:jpg,png,jpeg,bmp',
            ],
             
        );
         
        $job = new Job();
        $job->title = $request->title;
        $job->location = $request->location;
        $job->description = $request->description;
        $job->salary = $request->salary;
        $job->image = $request->salary;
      
        if($request->hasfile('image')){
            $name = rand().'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('uploads/property'), $name);  
            $job->image = $name;
         }


        $job->save();
        session()->flash('success', 'Job has been added successfully !!');
        return redirect()->route('job.index');
    }

    public function edit($id)
    {
        $job = Job::find($id);

        if (is_null($job)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('job.index');
        }
         
        return view('admin.job.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $job = Job::find($id);

        if (is_null($job)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('job.index');
        }
        
        
        $request->validate(
            [
                'title'  => 'required|string',
                'location'  => 'required',
                'description'  => 'required',
                'Salary'  => 'required',
             
               
            ],
             
        );
        
        $job->title = $request->title;
        $job->location = $request->location;
        $job->description = $request->description;
        $job->Salary = $request->Salary;

        if($request->hasfile('image')){
            $name = rand().'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('uploads/property'), $name);  
            $job->image = $name;
         }

        $job->save();

        session()->flash('success', 'Job has been updated successfully !!');
        return redirect()->route('job.index');
    }

    public function destroy($id)
    {
        $service = Job::find($id);

        if (is_null($service)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('job.index');
        }

         

        $service->deleted_by = auth()->id();
        $service->save();

        // Delete Service
        $service->delete();

        session()->flash('success', 'Job has been deleted permanently !!');
        return redirect()->route('job.index');
    }

     
}
