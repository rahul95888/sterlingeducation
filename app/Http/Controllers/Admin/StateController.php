<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\ServiceAllocation;
use App\Models\State;
use App\Models\Trade;
use App\Models\User;
use App\Models\UserCropDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StateController extends Controller
{
    public function index()
    {
        $datas = State::orderBy('id', 'desc')->get();
        // if (request()->ajax()) {
        //     $states = State::orderBy('id', 'desc')->get();
           
        //     $datatable = DataTables::of($states)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $csrf = "" . csrf_field() . "";
        //                 $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 $deleteRoute =  route('states.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" state_name="Edit State Details" href="' . route('states.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 $html .= '<a class="btn btn-danger btn-sm" state_name="Delete State" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';
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
        //         ->editColumn('state_name', function ($row) {
        //             return $row->state_name;
        //         })
        //         ->editColumn('state_code', function ($row) {
        //             return $row->state_code;
        //         })
        //         ->editColumn('country_uid', function ($row) {
        //             return $row->country ? $row->country->country_name : '';
        //         });
        //     $rawColumns = ['action', 'state_name', 'state_code', 'country_uid'];
        //     return $datatable->rawColumns($rawColumns)
        //         ->make(true);
        // }

        return view('admin.states.index',compact('datas'));
    }

    public function create()
    {
        $countries = Country::orderBy('country_name')->get();
        return view('admin.states.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                "state_name" => "required|string",
                'state_code'  => 'nullable|string',
                'country_uid'  => 'required|string|exists:countries,country_uid,deleted_at,NULL',
            ],
            [
                'country_uid.required' => 'Country is required!',
                'country_uid.exists' => "Country doesn't exists!",
            ]
        );

        $state_uid = get_random_id('states', 'state_uid');
        $exist = State::where(['state_name' => $request['state_name'], 'country_uid' => $request['country_uid']])->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['state_name' => 'State Name Already Exists'])->withInput();
        }
        $state = new State();

        $state->state_uid = $state_uid;
        $state->state_name = $request->state_name;
        $state->state_code = $request->state_code ?? null;
        $state->country_uid = $request->country_uid;
        $state->save();
        session()->flash('success', 'State has been created successfully !!');
        return redirect()->route('states.index');
    }

    public function edit($id)
    {
        $state = State::find($id);

        if (is_null($state)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('states.index');
        }
        $countries = Country::orderBy('country_name')->get();
        return view('admin.states.edit', compact('state', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $state = State::find($id);

        if (is_null($state)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('states.index');
        }

        $request->validate(
            [
                'state_name' => "required|string",
                'state_code'  => 'nullable|string',
                'country_uid'  => 'required|string|exists:countries,country_uid,deleted_at,NULL',
            ],
            [
                'country_uid.required' => 'Country is required!',
                'country_uid.exists' => "Country doesn't exists!",
            ]
        );
        $exist = State::where(['state_name' => $request['state_name'], 'country_uid' => $request['country_uid']])->where('state_uid', '!=', $state->state_uid)->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['state_name' => 'State Name Already Exists'])->withInput();
        }
        $state->state_name = $request->state_name;
        $state->state_code = $request->state_code ?? null;
        $state->country_uid = $request->country_uid;
        $state->save();

        session()->flash('success', 'State has been updated successfully !!');
        return redirect()->route('states.index');
    }

    public function destroy($id)
    {
        $state = State::find($id);

        if (is_null($state)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('states.index');
        }

        //check state deletable
        $deletable = $this->check_state_deletable($state->state_uid);
        if (!$deletable) {
            session()->flash('error', "State is already in use!");
            return redirect()->route('states.index');
        }

        $state->deleted_by = auth()->id();
        $state->save();

        // Delete State
        $state->delete();

        session()->flash('success', 'State has been deleted permanently !!');
        return redirect()->route('states.index');
    }

    public function check_state_deletable($state_uid)
    {
        $users = User::where('country_uid', $state_uid)->get();
        if (count($users) > 0) {
            return false;
        }

        $districts = District::where('state_uid', $state_uid)->get();
        if (count($districts) > 0) {
            return false;
        }
        $cities = City::where('state_uid', $state_uid)->get();
        if (count($cities) > 0) {
            return false;
        }
        $trades = Trade::where('state_uid', $state_uid)->get();
        if (count($trades) > 0) {
            return false;
        }
        $service_allocations = ServiceAllocation::where('state_uid', $state_uid)->get();
        if (count($service_allocations) > 0) {
            return false;
        }
        $user_crop_details = UserCropDetail::where('state_uid', $state_uid)->get();
        if (count($user_crop_details) > 0) {
            return false;
        }
        return true;
    }
}
