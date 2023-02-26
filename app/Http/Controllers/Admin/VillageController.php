<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\ServiceAllocation;
use App\Models\SubDistrict;
use App\Models\User;
use App\Models\UserCropDetail;
use App\Models\Village;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VillageController extends Controller
{
    public function index()
    {
        $datas = Village::orderBy('id', 'desc')->get();
        // if (request()->ajax()) {
        //     $villages = Village::orderBy('id', 'desc')->get();

        //     $datatable = DataTables::of($villages)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $csrf = "" . csrf_field() . "";
        //                 $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 $deleteRoute =  route('villages.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" village_name="Edit Village Details" href="' . route('villages.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 $html .= '<a class="btn btn-danger btn-sm" village_name="Delete Village" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';
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
        //         ->editColumn('village_name', function ($row) {
        //             return $row->village_name;
        //         })
        //         ->editColumn('sub_district_uid', function ($row) {
        //             return $row->subDistrict ? $row->subDistrict->sub_district_name : '';
        //         });
        //     $rawColumns = ['action', 'village_name', 'sub_district_uid'];
        //     return $datatable->rawColumns($rawColumns)
        //         ->make(true);
        // }

        return view('admin.villages.index',compact('datas'));
    }

    public function create()
    {
        $sub_districts = SubDistrict::get();
        return view('admin.villages.create', compact('sub_districts'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'village_name'  => 'required|string',
                'sub_district_uid'  => 'required|string|exists:sub_districts,sub_district_uid,deleted_at,NULL',
            ],
            [
                'sub_district_uid.required' => 'Sub District is required!',
                'sub_district_uid.exists' => "Sub District doesn't exists!",
            ]
        );
        $exist = Village::where(['village_name' => $request->village_name, 'sub_district_uid' => $request->sub_district_uid])->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['village_name' => 'This village name with same sub district name already exists!'])->withInput();
        }
        $village_uid = get_random_id('villages', 'village_uid');

        $village = new Village();
        $village->village_uid = $village_uid;
        $village->village_name = $request->village_name;
        $village->sub_district_uid = $request->sub_district_uid;
        $village->save();

        session()->flash('success', 'Village has been created successfully !!');
        return redirect()->route('villages.index');
    }

    public function edit($id)
    {
        $village = Village::find($id);

        if (is_null($village)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('villages.index');
        }
        $sub_districts = SubDistrict::get();
        return view('admin.villages.edit', compact('village', 'sub_districts'));
    }

    public function update(Request $request, $id)
    {
        $village = Village::find($id);

        if (is_null($village)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('villages.index');
        }

        $request->validate(
            [
                'village_name'  => 'required|string',
                'sub_district_uid'  => 'required|string|exists:sub_districts,sub_district_uid,deleted_at,NULL',
            ],
            [
                'sub_district_uid.required' => 'Sub District is required!',
                'sub_district_uid.exists' => "Sub District doesn't exists!",
            ]
        );
        $exist = Village::where(['village_name' => $request->village_name, 'sub_district_uid' => $request->sub_district_uid])->where('village_uid', '!=', $village->village_uid)->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['village_name' => 'This village name with same sub district name already exists!'])->withInput();
        } else {
            $village->village_name = $request->village_name;
            $village->sub_district_uid = $request->sub_district_uid;
            $village->save();
        }
        session()->flash('success', 'Village has been updated successfully !!');
        return redirect()->route('villages.index');
    }

    public function destroy($id)
    {
        $village = Village::find($id);

        if (is_null($village)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('villages.index');
        }

        //check village deletable
        $deletable = $this->check_village_deletable($village->village_uid);
        if (!$deletable) {
            session()->flash('error', "Sub District is already in use!");
            return redirect()->route('villages.index');
        }

        $village->deleted_by = auth()->id();
        $village->save();

        // Delete Village
        $village->delete();

        session()->flash('success', 'Village has been deleted permanently !!');
        return redirect()->route('villages.index');
    }

    public function check_village_deletable($village_uid)
    {
        $users = User::where('village_uid', $village_uid)->get();
        if (count($users) > 0) {
            return false;
        }
        $service_allocations = ServiceAllocation::where('village_uid', $village_uid)->get();
        if (count($service_allocations) > 0) {
            return false;
        }
        $user_crop_details = UserCropDetail::where('village_uid', $village_uid)->get();
        if (count($user_crop_details) > 0) {
            return false;
        }
        return true;
    }
}
