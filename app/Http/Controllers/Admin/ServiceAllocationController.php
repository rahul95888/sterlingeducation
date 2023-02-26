<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\District;
use App\Models\Service;
use App\Models\ServiceAllocation;
use App\Models\State;
use App\Models\SubDistrict;
use App\Models\Village;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServiceAllocationController extends Controller
{
    public function index()
    {
        $datas = ServiceAllocation::orderBy('id', 'desc')->get();
        // if (request()->ajax()) {
        //     $service_allocations = ServiceAllocation::orderBy('id', 'desc')->get();

        //     $datatable = DataTables::of($service_allocations)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $csrf = "" . csrf_field() . "";
        //                 $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 $deleteRoute =  route('service-allocations.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" title="Edit Service Allocation Details" href="' . route('service-allocations.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 $html .= '<a class="btn btn-danger btn-sm" title="Delete Service Allocation" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';
        //                 $delete_message = "You won't be able to revert this!";
        //                 $html .= '<script>
        //                     $("#deleteItem' . $row->id . '").click(function(){
        //                         swal.fire({ title: "Are you sure?",text: "' . $delete_message . '",type: "warning",showCancelButton: true,confirmButtonColor: "#DD6B55",confirmButtonText: "Yes, delete it!"
        //                         }).then((result) => { if (result.value) {$("#deleteForm' . $row->id . '").submit();}})
        //                     });
        //                 </script>';

        //                 $html .= '
        //                     <form id="deleteForm' . $row->id . '" action="' . $deleteRoute . '" method="post" style="display:none">' . $csrf . $method_delete . '
        //                         <button type="submit" class="btn waves-effect waves-light btn-rounded btn-success"><i
        //                                 class="icofont icofont-check"></i> Confirm Delete</button>
        //                         <button type="button" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal"><i
        //                                 class="fa fa-times"></i> Cancel</button>
        //                     </form>';
        //                 return $html;
        //             }
        //         )
        //         ->editColumn('service_uid', function ($row) {
        //             return $row->service ? $row->service->service_name : '';
        //         })
        //         ->editColumn('state_uid', function ($row) {
        //             return $row->state ? $row->state->state_name : '';
        //         })
        //         ->editColumn('district_uid', function ($row) {
        //             return $row->district ? $row->district->district_name : '';
        //         })
        //         ->editColumn('sub_district_uid', function ($row) {
        //             return $row->subDistrict ? $row->subDistrict->sub_district_name : '';
        //         })
        //         ->editColumn('village_uid', function ($row) {
        //             return $row->village ? $row->village->village_name : '';
        //         });
        //     $rawColumns = ['action', 'service_uid', 'state_uid', 'district_uid', 'sub_district_uid', 'village_uid'];
        //     return $datatable->rawColumns($rawColumns)
        //         ->make(true);
        // }

        return view('admin.service-allocations.index',compact('datas'));
    }

    public function create()
    {
        $services = Service::all();
        $states = State::with('district')->get();
        $districts = District::with('sub_district')->get();

        $sub_districts = SubDistrict::all();
        $villages = Village::all();
        return view('admin.service-allocations.create', compact('services', 'states', 'districts', 'sub_districts', 'villages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_uid'  => 'required|string|exists:services,service_uid,deleted_at,NULL',
            'state_uid'  => 'required|string|exists:states,state_uid,deleted_at,NULL',
            'district_uid'  => 'required|string|exists:districts,district_uid,deleted_at,NULL',
            'sub_district_uid'  => 'required|string|exists:sub_districts,sub_district_uid,deleted_at,NULL',
            'village_uid'  => 'required|string|exists:villages,village_uid,deleted_at,NULL',
        ], [
            'service_uid.required' => 'Service is required!',
            'service_uid.exists' => "Service doesn't exists!",
            'state_uid.required' => 'State is required!',
            'state_uid.exists' => "State doesn't exists!",
            'district_uid.required' => 'District is required!',
            'district_uid.exists' => "District doesn't exists!",
            'sub_district_uid.required' => 'Sub District is required!',
            'sub_district_uid.exists' => "Sub District doesn't exists!",
            'village_uid.required' => 'Village is required!',
            'village_uid.exists' => "Village doesn't exists!",
        ]);

        $exist = ServiceAllocation::where(
            [
                'service_uid' => $request['service_uid'],
                'state_uid' => $request['state_uid'],
                'district_uid' => $request['district_uid'],
                'sub_district_uid' => $request['sub_district_uid'],
                'village_uid' => $request['village_uid']
            ]
        )->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['state_name' => 'Service allocation already exists by following data!'])->withInput();
        } else {

            $service_allocation_uid = get_random_id('service_allocations', 'service_allocation_uid');

            $service_allocation = new ServiceAllocation();
            $service_allocation->service_allocation_uid = $service_allocation_uid;
            $service_allocation->service_uid = $request->service_uid;
            $service_allocation->state_uid = $request->state_uid ?? null;
            $service_allocation->district_uid = $request->district_uid ?? null;
            $service_allocation->sub_district_uid = $request->sub_district_uid ?? null;
            $service_allocation->village_uid = $request->village_uid ?? null;
            $service_allocation->save();

            session()->flash('success', 'Service Allocation has been created successfully !!');
        }

        return redirect()->route('service-allocations.index');
    }

    public function edit($id)
    {
        $service_allocation = ServiceAllocation::find($id);

        if (is_null($service_allocation)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('service-allocations.index');
        }
        $services = Service::all();
        $states = State::with('district')->get();
        $districts = District::all();
        $sub_districts = SubDistrict::all();
        $villages = Village::all();
        return view('admin.service-allocations.edit', compact('service_allocation', 'services', 'states', 'districts', 'sub_districts', 'villages'));
    }

    public function update(Request $request, $id)
    {
        $service_allocation = ServiceAllocation::find($id);

        if (is_null($service_allocation)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('service-allocations.index');
        }

        $request->validate([
            'service_uid'  => 'required|string|exists:services,service_uid,deleted_at,NULL',
            'state_uid'  => 'required|string|exists:states,state_uid,deleted_at,NULL',
            'district_uid'  => 'required|string|exists:districts,district_uid,deleted_at,NULL',
            'sub_district_uid'  => 'required|string|exists:sub_districts,sub_district_uid,deleted_at,NULL',
            'village_uid'  => 'required|string|exists:villages,village_uid,deleted_at,NULL',
        ], [
            'service_uid.required' => 'Service is required!',
            'service_uid.exists' => "Service doesn't exists!",
            'state_uid.required' => 'State is required!',
            'state_uid.exists' => "State doesn't exists!",
            'district_uid.required' => 'District is required!',
            'district_uid.exists' => "District doesn't exists!",
            'sub_district_uid.required' => 'Sub District is required!',
            'sub_district_uid.exists' => "Sub District doesn't exists!",
            'village_uid.required' => 'Village is required!',
            'village_uid.exists' => "Village doesn't exists!",
        ]);
        $exist = ServiceAllocation::where(
            [
                'service_uid' => $request['service_uid'],
                'state_uid' => $request['state_uid'],
                'district_uid' => $request['district_uid'],
                'sub_district_uid' => $request['sub_district_uid'],
                'village_uid' => $request['village_uid']
            ]
        )->where('service_allocation_uid', '!=', $service_allocation->service_allocation_uid)->exists();

        if ($exist == true) {
            return redirect()->back()->withErrors(['service_uid' => 'Service allocation already exists by following data!'])->withInput();
        } else {

            $service_allocation->service_uid = $request->service_uid;
            $service_allocation->state_uid = $request->state_uid ?? null;
            $service_allocation->district_uid = $request->district_uid ?? null;
            $service_allocation->sub_district_uid = $request->sub_district_uid ?? null;
            $service_allocation->village_uid = $request->village_uid ?? null;
            $service_allocation->save();

            session()->flash('success', 'Service Allocation has been updated successfully !!');
        }
        return redirect()->route('service-allocations.index');
    }

    public function destroy($id)
    {
        $service_allocation = ServiceAllocation::find($id);

        if (is_null($service_allocation)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('service-allocations.index');
        }

        $service_allocation->deleted_by = auth()->id();
        $service_allocation->save();

        // Delete Service Allocation
        $service_allocation->delete();

        session()->flash('success', 'Service Allocation has been deleted permanently !!');
        return redirect()->route('service-allocations.index');
    }
}
