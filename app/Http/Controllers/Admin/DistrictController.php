<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\ServiceAllocation;
use App\Models\State;
use App\Models\SubDistrict;
use App\Models\User;
use App\Models\UserCropDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DistrictController extends Controller
{
    public function index()
    {
        $datas = District::orderBy('id', 'desc')->get();
        // if (request()->ajax()) {
        //     $districts = District::orderBy('id', 'desc')->get();

        //     $datatable = DataTables::of($districts)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $csrf = "" . csrf_field() . "";
        //                 $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 $deleteRoute =  route('districts.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" district_name="Edit District Details" href="' . route('districts.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 $html .= '<a class="btn btn-danger btn-sm" district_name="Delete District" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';
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
        //         ->editColumn('district_name', function ($row) {
        //             return $row->district_name;
        //         })
        //         ->editColumn('state_uid', function ($row) {
        //             return $row->state ? $row->state->state_name : '';
        //         });
        //     $rawColumns = ['action', 'district_name', 'state_uid'];
        //     return $datatable->rawColumns($rawColumns)
        //         ->make(true);
        // }

        return view('admin.districts.index',compact('datas'));
    }

    public function create()
    {
        $states = State::get();
        return view('admin.districts.create', compact('states'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                "district_name" => "required|string",
                'state_uid'  => 'required|string|exists:states,state_uid,deleted_at,NULL',
            ],
            [
                'state_uid.required'  => 'State is required!',
                'state_uid.exists'  => "State doesn't exists!",
            ]
        );

        $district_uid = get_random_id('districts', 'district_uid');
        $exist = District::where(['district_name' => $request['district_name'], 'state_uid' => $request['state_uid']])->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['district_name' => 'This district name with same state name already exists!'])->withInput();
        }
        $district = new District();
        $district->district_uid = $district_uid;
        $district->district_name = $request->district_name;
        $district->state_uid = $request->state_uid;
        $district->save();

        session()->flash('success', 'District has been created successfully !!');
        return redirect()->route('districts.index');
    }

    public function edit($id)
    {
        $district = District::find($id);

        if (is_null($district)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('districts.index');
        }
        $states = State::get();
        return view('admin.districts.edit', compact('district', 'states'));
    }

    public function update(Request $request, $id)
    {
        $district = District::find($id);

        if (is_null($district)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('districts.index');
        }

        $request->validate(
            [
                'district_name' => "required|string",
                'state_uid'  => 'required|string|exists:states,state_uid,deleted_at,NULL',
            ],
            [
                'state_uid.required'  => 'State is required!',
                'state_uid.exists'  => "State doesn't exists!",
            ]
        );
        $exist = District::where(['district_name' => $request['district_name'], 'state_uid' => $request['state_uid']])->where('district_uid', '!=', $district->district_uid)->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['district_name' => 'This district name with same state name already exists!'])->withInput();
        }
        $district->district_name = $request->district_name;
        $district->state_uid = $request->state_uid;
        $district->save();

        session()->flash('success', 'District has been updated successfully !!');
        return redirect()->route('districts.index');
    }

    public function destroy($id)
    {
        $district = District::find($id);

        if (is_null($district)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('districts.index');
        }

        //check district deletable
        $deletable = $this->check_district_deletable($district->district_uid);
        if (!$deletable) {
            session()->flash('error', "District is already in use!");
            return redirect()->route('districts.index');
        }

        $district->deleted_by = auth()->id();
        $district->save();

        // Delete District
        $district->delete();

        session()->flash('success', 'District has been deleted permanently !!');
        return redirect()->route('districts.index');
    }

    public function check_district_deletable($district_uid)
    {
        $users = User::where('district_uid', $district_uid)->get();
        if (count($users) > 0) {
            return false;
        }
        $sub_districts = SubDistrict::where('district_uid', $district_uid)->get();
        if (count($sub_districts) > 0) {
            return false;
        }
        $service_allocations = ServiceAllocation::where('district_uid', $district_uid)->get();
        if (count($service_allocations) > 0) {
            return false;
        }
        $user_crop_details = UserCropDetail::where('district_uid', $district_uid)->get();
        if (count($user_crop_details) > 0) {
            return false;
        }
        return true;
    }
}
