<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\ServiceAllocation;
use App\Models\State;
use App\Models\SubDistrict;
use App\Models\City;
use App\Models\User;
use App\Models\UserCropDetail;
use App\Models\Village;
use App\Models\Pincode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;

class SubDistrictController extends Controller
{
    public function index()
    {
        $datas = SubDistrict::orderBy('id', 'desc')->get();
        // if (request()->ajax()) {
        //     $sub_districts = SubDistrict::orderBy('id', 'desc')->get();

        //     $datatable = DataTables::of($sub_districts)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $csrf = "" . csrf_field() . "";
        //                 $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 $deleteRoute =  route('sub-districts.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" sub_district_name="Edit Sub District Details" href="' . route('sub-districts.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 $html .= '<a class="btn btn-danger btn-sm" sub_district_name="Delete SubDistrict" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';
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
        //         ->editColumn('sub_district_name', function ($row) {
        //             return $row->sub_district_name;
        //         })
        //         ->editColumn('district_uid', function ($row) {
        //             return $row->district ? $row->district->district_name : '';
        //         });
        //     $rawColumns = ['action', 'sub_district_name', 'district_uid'];
        //     return $datatable->rawColumns($rawColumns)
        //         ->make(true);
        // }

        return view('admin.sub-districts.index',compact('datas'));
    }

    public function create()
    {
        $districts = District::get();
        return view('admin.sub-districts.create', compact('districts'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'sub_district_name'  => 'required|string',
                'district_uid'  => 'required|string|exists:districts,district_uid,deleted_at,NULL',
            ],
            [
                'district_uid.required' => 'District is required!',
                'district_uid.exists' => "District doesn't exists!",
            ]
        );

        $exist = SubDistrict::where(['sub_district_name' => $request['sub_district_name'], 'district_uid' => $request['district_uid']])->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['sub_district_name' => 'This sub district name with same district name already exists!'])->withInput();
        }

        $sub_district_uid = get_random_id('sub_districts', 'sub_district_uid');

        $sub_district = new SubDistrict();
        $sub_district->sub_district_uid = $sub_district_uid;
        $sub_district->sub_district_name = $request->sub_district_name;
        $sub_district->district_uid = $request->district_uid;
        $sub_district->save();

        session()->flash('success', 'Sub District has been created successfully !!');
        return redirect()->route('sub-districts.index');
    }

    public function edit($id)
    {
        $sub_district = SubDistrict::find($id);

        if (is_null($sub_district)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('sub-districts.index');
        }
        $districts = District::get();
        return view('admin.sub-districts.edit', compact('sub_district', 'districts'));
    }

    public function update(Request $request, $id)
    {
        $sub_district = SubDistrict::find($id);

        if (is_null($sub_district)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('sub-districts.index');
        }

        $request->validate(
            [
                'sub_district_name'  => 'required|string',
                'district_uid'  => 'required|string|exists:districts,district_uid,deleted_at,NULL',
            ],
            [
                'district_uid.required' => 'District is required!',
                'district_uid.exists' => "District doesn't exists!",
            ]
        );

        $exist = SubDistrict::where(['sub_district_name' => $request['sub_district_name'], 'district_uid' => $request['district_uid']])->where('sub_district_uid', '!=', $sub_district->sub_district_uid)->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['sub_district_name' => 'This sub district name with same district name already exists!'])->withInput();
        }

        $sub_district->sub_district_name = $request->sub_district_name;
        $sub_district->district_uid = $request->district_uid;
        $sub_district->save();

        session()->flash('success', 'Sub District has been updated successfully !!');
        return redirect()->route('sub-districts.index');
    }

    public function destroy($id)
    {
        $sub_district = SubDistrict::find($id);

        if (is_null($sub_district)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('sub-districts.index');
        }

        //check sub district deletable
        $deletable = $this->check_sub_district_deletable($sub_district->sub_district_uid);
        if (!$deletable) {
            session()->flash('error', "Sub District is already in use!");
            return redirect()->route('sub-districts.index');
        }

        $sub_district->deleted_by = auth()->id();
        $sub_district->save();

        // Delete Sub District
        $sub_district->delete();

        session()->flash('success', 'Sub District has been deleted permanently !!');
        return redirect()->route('sub-districts.index');
    }

    public function check_sub_district_deletable($sub_district_uid)
    {
        $users = User::where('sub_district_uid', $sub_district_uid)->get();
        if (count($users) > 0) {
            return false;
        }
        $villages = Village::where('sub_district_uid', $sub_district_uid)->get();
        if (count($villages) > 0) {
            return false;
        }
        $service_allocations = ServiceAllocation::where('sub_district_uid', $sub_district_uid)->get();
        if (count($service_allocations) > 0) {
            return false;
        }
        $user_crop_details = UserCropDetail::where('sub_district_uid', $sub_district_uid)->get();
        if (count($user_crop_details) > 0) {
            return false;
        }
        return true;
    }

    public function getSubDistrict(Request $request)
    {

        $data['subDistrict'] = SubDistrict::where('district_uid', $request->district_uid)->get();
        return response($data);
    }
    public function getVillage(Request $request)
    {
        $data['village'] = Village::where('sub_district_uid', $request->sub_district_uid)->get();
        return response($data);
    }
    public function getState(Request $request)
    {
        $data = State::where('country_uid', $request->country_uid)->get();
        return response($data);
    }
    public function getDistrict(Request $request)
    {

        $data = District::where('state_uid', $request->state_uid)->get();
        return response($data);
    }
    public function getCity(Request $request){
        $data = City::where('state_uid', $request->state_uid)->get();
        return response($data);
    }
    
    public function getPincode(Request $request){
        $data = Pincode::where('city_uid', $request->city_uid)->get();
        return response($data);
    }
}
