<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use App\Models\Trade;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    public function index()
    {
        $datas = Country::orderBy('id', 'desc')->get();
        // if (request()->ajax()) {
        //     $countries = Country::orderBy('id', 'desc')->get();

        //     $datatable = DataTables::of($countries)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $csrf = "" . csrf_field() . "";
        //                 $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 $deleteRoute =  route('countries.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" country_name="Edit Country Details" href="' . route('countries.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 $html .= '<a class="btn btn-danger btn-sm" country_name="Delete Country" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';
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
        //         ->editColumn('country_name', function ($row) {
        //             return $row->country_name;
        //         })
        //         ->editColumn('country_code', function ($row) {
        //             return $row->country_code;
        //         });
        //     $rawColumns = ['action', 'country_name', 'country_code'];
        //     return $datatable->rawColumns($rawColumns)
        //         ->make(true);
        // }

        return view('admin.countries.index',compact('datas'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "country_name" => "required|string|unique:countries,country_name,NULL,id,deleted_at,NULL",
            "country_code" => "required|string",
        ]);

        $country_uid = get_random_id('countries', 'country_uid');
        $country = new Country();
        $country->country_uid = $country_uid;
        $country->country_name = $request->country_name;
        $country->country_code = $request->country_code;
        $country->save();

        session()->flash('success', 'Country has been created successfully !!');
        return redirect()->route('countries.index');
    }

    public function edit($id)
    {
        $country = Country::find($id);

        if (is_null($country)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('countries.index');
        }
        return view('admin.countries.edit', compact('country'));
    }

    public function update(Request $request, $id)
    {
        $country = Country::find($id);

        if (is_null($country)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('countries.index');
        }

        $request->validate([
            'country_name' => "required|string|unique:countries,country_name,{$country->id},id,deleted_at,NULL",
            'country_code' => "required|string"
        ]);

        $country->country_name = $request->country_name;
        $country->country_code = $request->country_code;
        $country->save();
        session()->flash('success', 'Country has been updated successfully !!');

        return redirect()->route('countries.index');
    }

    public function destroy($id)
    {
        $country = Country::find($id);

        if (is_null($country)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('countries.index');
        }

        //check country deletable 
        $deletable = $this->check_country_deletable($country->country_uid);
        if (!$deletable) {
            session()->flash('error', "Country is already in use!");
            return redirect()->route('countries.index');
        }

        $country->deleted_by = auth()->id();
        $country->save();

        // Delete Country
        $country->delete();

        session()->flash('success', 'Country has been deleted permanently !!');
        return redirect()->route('countries.index');
    }
    public function check_country_deletable($country_uid)
    {
        $users = User::where('country_uid', $country_uid)->get();
        if (count($users) > 0) {
            return false;
        }
        $states = State::where('country_uid', $country_uid)->get();
        if (count($states) > 0) {
            return false;
        }
        $trades = Trade::where('country_uid', $country_uid)->get();
        if (count($trades) > 0) {
            return false;
        }
        return true;
    }
}
