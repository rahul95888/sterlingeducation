<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Pincode;
use App\Models\State;
use App\Models\Trade;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    public function index()
    {
        $datas = City::orderBy('id', 'desc')->get();
        // if (request()->ajax()) {
        //     $cities = City::orderBy('id', 'desc')->get();

        //     $datatable = DataTables::of($cities)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $csrf = "" . csrf_field() . "";
        //                 $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 $deleteRoute =  route('cities.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" title="Edit City Details" href="' . route('cities.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 $html .= '<a class="btn btn-danger btn-sm" title="Delete City" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';
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

        //         ->editColumn('city_name', function ($row) {
        //             return $row->city_name;
        //         })
        //         ->editColumn('city_code', function ($row) {
        //             return $row->city_code;
        //         })
        //         ->editColumn('state_uid', function ($row) {
        //             return $row->state ? $row->state->state_name : '';
        //         })
        //         ->editColumn('latitude', function ($row) {
        //             return $row->latitude;
        //         })
        //         ->editColumn('longitude', function ($row) {
        //             return $row->longitude;
        //         });
        //     $rawColumns = ['action', 'city_name', 'city_code', 'state_uid', 'latitude', 'longitude'];
        //     return $datatable->rawColumns($rawColumns)
        //         ->make(true);
        // }

        return view('admin.cities.index',compact('datas'));
    }

    public function create()
    {
        $states = State::get();
        return view('admin.cities.create', compact('states'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                "city_name" => "required|string",
                'city_code'  => 'nullable|string',
                'state_uid'  => 'required|string|exists:states,state_uid,deleted_at,NULL',
                'latitude'  => 'required|nullable|string',
                'longitude'  => 'required|nullable|string',
            ],
            [
                'state_uid.required'  => 'State is required!',
                'state_uid.exists'  => "State doesn't exists!",
            ]
        );
        $exist = City::where(['city_name' => $request['city_name'], 'state_uid' => $request['state_uid']])->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['city_name' => 'City Name Already Exists'])->withInput();
        }
        $city_uid = get_random_id('cities', 'city_uid');

        $city = new City();
        $city->city_uid = $city_uid;
        $city->city_name = $request->city_name;
        $city->city_code = $request->city_code ?? null;
        $city->state_uid = $request->state_uid;
        $city->latitude = $request->latitude ?? null;
        $city->longitude = $request->longitude ?? null;
        $city->save();

        session()->flash('success', 'City has been created successfully !!');
        return redirect()->route('cities.index');
    }

    public function edit($id)
    {
        $city = City::find($id);

        if (is_null($city)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('cities.index');
        }
        $states = State::get();

        return view('admin.cities.edit', compact('city', 'states'));
    }

    public function update(Request $request, $id)
    {
        $city = City::find($id);

        if (is_null($city)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('cities.index');
        }

        $request->validate(
            [
                'city_name' => "required|string",
                'city_code'  => 'nullable|string',
                'state_uid'  => 'required|string|exists:states,state_uid,deleted_at,NULL',
                'latitude'  => 'required|nullable|string',
                'longitude'  => 'required|nullable|string',
            ],
            [
                'state_uid.required'  => 'State is required!',
                'state_uid.exists'  => "State doesn't exists!",
            ]
        );
        $exist = City::where(['city_name' => $request->city_name, 'state_uid' => $request->state_uid])->where('city_uid', '!=', $city->city_uid)->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['city_name' => 'City Name Already Exists'])->withInput();
        }
        $city->city_name = $request->city_name;
        $city->city_code = $request->city_code ?? null;
        $city->state_uid = $request->state_uid;
        $city->latitude = $request->latitude ?? null;
        $city->longitude = $request->longitude ?? null;
        $city->save();

        session()->flash('success', 'City has been updated successfully !!');
        return redirect()->route('cities.index');
    }

    public function destroy($id)
    {
        $city = City::find($id);

        if (is_null($city)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('cities.index');
        }

        //check city deletable
        $deletable = $this->check_city_deletable($city->city_uid);
        if (!$deletable) {
            session()->flash('error', "City is already in use!");
            return redirect()->route('cities.index');
        }

        $city->deleted_by = auth()->id();
        $city->save();

        // Delete City
        $city->delete();

        session()->flash('success', 'City has been deleted permanently !!');
        return redirect()->route('cities.index');
    }

    public function check_city_deletable($city_uid)
    {
        $pincodes = Pincode::where('city_uid', $city_uid)->get();
        if (count($pincodes) > 0) {
            return false;
        }
        $trades = Trade::where('city_uid', $city_uid)->get();
        if (count($trades) > 0) {
            return false;
        }
        return true;
    }
}
