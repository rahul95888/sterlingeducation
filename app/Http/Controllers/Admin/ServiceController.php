<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Commodity;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Service;
use App\Models\ServiceAllocation;

class ServiceController extends Controller
{
    public function index()
    {
        $datas = Service::orderBy('id', 'desc')->get();
        return view('admin.services.index',compact('datas'));
    }

    public function create()
    {
        $commodities = Commodity::all();
        return view('admin.services.create', compact('commodities'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'service_name'  => 'required|string',
                'commodity_uid'  => 'required',
            ],
             
        );
         
        $service = new Service();
        $service->service_name = $request->service_name;
        $service->commodity_uid = $request->commodity_uid;
        if($request->hasfile('image')){
            $name = rand().'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('uploads/property'), $name);  
            $service->image = $name;
         }
        $service->save();
        session()->flash('success', 'Service has been created successfully !!');
        return redirect()->route('services.index');
    }

    public function edit($id)
    {
        $service = Service::find($id);

        if (is_null($service)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('services.index');
        }
        $commodities = Commodity::all();
        return view('admin.services.edit', compact('service', 'commodities'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        if (is_null($service)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('services.index');
        }

        $request->validate(
            [
                'service_name'  => 'required|string',
                'commodity_uid'  => 'required',
            ]
            
        );
        
        $service->service_name = $request->service_name;
        $service->commodity_uid = $request->commodity_uid;

        if($request->hasfile('image')){
            $name = rand().'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('uploads/property'), $name);  
            $service->image = $name;
         }

        $service->save();

        session()->flash('success', 'Service has been updated successfully !!');
        return redirect()->route('services.index');
    }

    public function destroy($id)
    {
        $service = Service::find($id);

        if (is_null($service)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('services.index');
        }

        //check state deletable
        $deletable = $this->check_service_deletable($service->service_uid);
        if (!$deletable) {
            session()->flash('error', "Service is already in use!");
            return redirect()->route('services.index');
        }

        $service->deleted_by = auth()->id();
        $service->save();

        // Delete Service
        $service->delete();

        session()->flash('success', 'Service has been deleted permanently !!');
        return redirect()->route('services.index');
    }

    public function check_service_deletable($service_uid)
    {
        $service_allocations = ServiceAllocation::where('service_uid', $service_uid)->get();
        if (count($service_allocations) > 0) {
            return false;
        }
        return true;
    }
}
