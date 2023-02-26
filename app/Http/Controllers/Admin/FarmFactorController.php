<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FarmFactor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FarmFactorController extends Controller
{

    public function index()
    {
        $datas = FarmFactor::orderBy('id', 'desc')->get();
        // if (request()->ajax()) {
        //     $farm_factors = FarmFactor::select('farm_factors.*');

        //     $datatable = DataTables::of($farm_factors)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $csrf = "" . csrf_field() . "";
        //                 $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 $deleteRoute =  route('farm-factors.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" title="Edit FarmFactor Details" href="' . route('farm-factors.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 $html .= '<a class="btn btn-danger btn-sm" title="Delete FarmFactor" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';
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

        return view('admin.farm-factors.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.farm-factors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "farm_factor_name" => "required|string|unique:farm_factors,farm_factor_name,NULL,id,deleted_at,NULL"
        ]);

        $farm_factor_uid = get_random_id('farm_factors', 'farm_factor_uid');

        $farm_factor = new FarmFactor();
        $farm_factor->farm_factor_uid = $farm_factor_uid;
        $farm_factor->farm_factor_name = $request->farm_factor_name;
        $farm_factor->save();

        session()->flash('success', 'Form Factor has been created successfully !!');
        return redirect()->route('farm-factors.index');
    }

    public function edit($id)
    {
        $farm_factor = FarmFactor::find($id);

        if (is_null($farm_factor)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('farm-factors.index');
        }

        return view('admin.farm-factors.edit', compact('farm_factor'));
    }

    public function update(Request $request, $id)
    {
        $farm_factor = FarmFactor::find($id);

        if (is_null($farm_factor)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('farm-factors.index');
        }

        $request->validate([
            'farm_factor_name' => "required|string|unique:farm_factors,farm_factor_name,{$farm_factor->id},id,deleted_at,NULL",
        ]);

        $farm_factor->farm_factor_name = $request->farm_factor_name;
        $farm_factor->save();

        session()->flash('success', 'Form Factor has been updated successfully !!');
        return redirect()->route('farm-factors.index');
    }

    public function destroy($id)
    {
        $farm_factor = FarmFactor::find($id);

        if (is_null($farm_factor)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('farm-factors.index');
        }

        $farm_factor->deleted_by = auth()->id();
        $farm_factor->save();

        // Delete FarmFactor
        $farm_factor->delete();

        session()->flash('success', 'Form Factor has been deleted permanently !!');
        return redirect()->route('farm-factors.index');
    }
}
