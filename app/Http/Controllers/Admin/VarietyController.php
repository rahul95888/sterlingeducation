<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commodity;
use App\Models\Trade;
use App\Models\UserCropDetail;
use App\Models\Variety;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VarietyController extends Controller
{
    public function index()
    {
        $datas = Variety::get();
        // if (request()->ajax()) {
        //     $varieties = Variety::with('commodity')->select('varieties.*');

        //     $datatable = DataTables::of($varieties)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $csrf = "" . csrf_field() . "";
        //                 $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 $deleteRoute =  route('varieties.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" title="Edit Variety Details" href="' . route('varieties.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 $html .= '<a class="btn btn-danger btn-sm" title="Delete Variety" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';

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
        //         );
        //     $rawColumns = ['action'];
        //     return $datatable->rawColumns($rawColumns)->make(true);
        // }

        return view('admin.varieties.index',compact('datas'));
    }

    public function create()
    {
        $commodities = Commodity::all();
        return view('admin.varieties.create', compact('commodities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'variety_name'  => 'required|string',
            'commodity_uid'  => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
            'from_price'  => 'required_with:to_price|lt:to_price',
            'to_price'  => 'required_with:from_price|gt:from_price',
        ], [
            'commodity_uid.required' => 'Commodity is required!',
            'commodity_uid.exists' => "Commodity doesn't exists!",
        ]);

        $exist = Variety::where(['variety_name' => $request->variety_name, 'commodity_uid' => $request->commodity_uid])->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['commodity_uid' => 'This variety name with same commodity name already exists!'])->withInput();
        }

        $variety_uid = get_random_id('varieties', 'variety_uid');

        $variety = new Variety();
        $variety->variety_uid = $variety_uid;
        $variety->variety_name = $request->variety_name;
        $variety->commodity_uid = $request->commodity_uid;
        $variety->from_price = $request->from_price;
        $variety->to_price = $request->to_price;
        $variety->save();

        session()->flash('success', 'Variety has been created successfully !!');
        return redirect()->route('varieties.index');
    }

    public function edit($id)
    {
        $variety = Variety::find($id);

        if (is_null($variety)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('varieties.index');
        }
        $commodities = Commodity::all();

        return view('admin.varieties.edit', compact('variety', 'commodities'));
    }

    public function update(Request $request, $id)
    {
        $variety = Variety::find($id);

        if (is_null($variety)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('varieties.index');
        }

        $request->validate([
            'variety_name'  => 'required|string',
            'commodity_uid'  => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
            'from_price'  => 'required_with:to_price|lt:to_price',
            'to_price'  => 'required_with:from_price|gt:from_price',
        ], [
            'commodity_uid.required' => 'Commodity is required!',
            'commodity_uid.exists' => "Commodity doesn't exists!",
        ]);

        $exist = Variety::where(['variety_name' => $request->variety_name, 'commodity_uid' => $request->commodity_uid])->where('variety_uid', '!=', $variety->variety_uid)->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['commodity_uid' => 'This variety name with same commodity name already exists!'])->withInput();
        }

        $variety->variety_name = $request->variety_name;
        $variety->commodity_uid = $request->commodity_uid;
        $variety->from_price = $request->from_price;
        $variety->to_price = $request->to_price;
        $variety->save();

        session()->flash('success', 'Variety has been updated successfully !!');
        return redirect()->route('varieties.index');
    }

    public function destroy($id)
    {
        $variety = Variety::find($id);

        if (is_null($variety)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('varieties.index');
        }

        //check variety deletable 
        $deletable = $this->check_variety_deletable($variety->variety_uid);
        if (!$deletable) {
            session()->flash('error', "Variety is already in use!");
            return redirect()->route('varieties.index');
        }

        $variety->deleted_by = auth()->id();
        $variety->save();

        // Delete Variety
        $variety->delete();

        session()->flash('success', 'Variety has been deleted permanently !!');
        return redirect()->route('varieties.index');
    }

    public function check_variety_deletable($variety_uid)
    {
        $user_crop_details = UserCropDetail::where('variety_uid', $variety_uid)->get();
        if (count($user_crop_details) > 0) {
            return false;
        }
        $trades = Trade::where('variety_uid', $variety_uid)->get();
        if (count($trades) > 0) {
            return false;
        }
        return true;
    }
}
