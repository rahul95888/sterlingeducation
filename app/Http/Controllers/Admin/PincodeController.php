<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Pincode;
use App\Models\Trade;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PincodeController extends Controller
{
    public function index()
    {
        $datas = Pincode::orderBy('id', 'desc')->get();
        // if (request()->ajax()) {
        //     $pincodes = Pincode::orderBy('id', 'desc')->get();

        //     $datatable = DataTables::of($pincodes)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $csrf = "" . csrf_field() . "";
        //                 $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 $deleteRoute =  route('pincodes.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" pincode_name="Edit Pincode Details" href="' . route('pincodes.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 $html .= '<a class="btn btn-danger btn-sm" pincode_name="Delete Pincode" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';
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
        //         ->editColumn('pincode', function ($row) {
        //             return $row->pincode;
        //         })
        //         ->editColumn('city_uid', function ($row) {
        //             return $row->city ? $row->city->city_name : '';
        //         });
        //     $rawColumns = ['action', 'pincode', 'city_uid'];
        //     return $datatable->rawColumns($rawColumns)
        //         ->make(true);
        // }

        return view('admin.pincodes.index',compact('datas'));
    }

    public function create()
    {
        $cities = City::get();
        return view('admin.pincodes.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                "pincode" => "required|numeric|digits:6|unique:pincodes,pincode,NULL,id,deleted_at,NULL",
                'city_uid'  => 'required|string|exists:cities,city_uid,deleted_at,NULL',
            ],
            [
                'city_uid.required' => 'City is required!',
                'city_uid.exists' => "City doesn't exists!",
            ]
        );

        $pincode_uid = get_random_id('pincodes', 'pincode_uid');

        $pincode = new Pincode();
        $pincode->pincode_uid = $pincode_uid;
        $pincode->pincode = $request->pincode;
        $pincode->city_uid = $request->city_uid;
        $pincode->save();

        session()->flash('success', 'Pincode has been created successfully !!');
        return redirect()->route('pincodes.index');
    }

    public function edit($id)
    {
        $pincode = Pincode::find($id);

        if (is_null($pincode)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('pincodes.index');
        }
        $cities = City::get();
        return view('admin.pincodes.edit', compact('pincode', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $pincode = Pincode::find($id);

        if (is_null($pincode)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('pincodes.index');
        }

        $request->validate(
            [
                'pincode' => "required|numeric|digits:6|unique:pincodes,pincode,{$pincode->id},id,deleted_at,NULL",
                'city_uid'  => 'required|string|exists:cities,city_uid,deleted_at,NULL',
            ],
            [
                'city_uid.required' => 'City is required!',
                'city_uid.exists' => "City doesn't exists!",
            ]
        );

        $pincode->pincode = $request->pincode;
        $pincode->city_uid = $request->city_uid;
        $pincode->save();

        session()->flash('success', 'Pincode has been updated successfully !!');
        return redirect()->route('pincodes.index');
    }

    public function destroy($id)
    {
        $pincode = Pincode::find($id);

        if (is_null($pincode)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('pincodes.index');
        }

        //check pincode deletable 
        $deletable = $this->check_pincode_deletable($pincode->pincode_uid);
        if (!$deletable) {
            session()->flash('error', "City is already in use!");
            return redirect()->route('cities.index');
        }

        $pincode->deleted_by = auth()->id();
        $pincode->save();

        // Delete Pincode
        $pincode->delete();

        session()->flash('success', 'Pincode has been deleted permanently !!');
        return redirect()->route('pincodes.index');
    }

    public function check_pincode_deletable($pincode_uid)
    {
        $users = User::where('pincode_uid', $pincode_uid)->get();
        if (count($users) > 0) {
            return false;
        }
        $trades = Trade::where('pincode_uid', $pincode_uid)->get();
        if (count($trades) > 0) {
            return false;
        }

        return true;
    }
}
