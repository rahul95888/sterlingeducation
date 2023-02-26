<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserProcurement;
use App\Models\WarehouseType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WarehouseTypeController extends Controller
{
    public function index()
    {
        $datas = WarehouseType::orderBy('id', 'desc')->get();
        // if (request()->ajax()) {
        //     $warehouse_types = WarehouseType::select('warehouse_types.*');

        //     $datatable = DataTables::of($warehouse_types)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $csrf = "" . csrf_field() . "";
        //                 $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 $deleteRoute =  route('warehouse-types.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" title="Edit Warehouse Type Details" href="' . route('warehouse-types.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 $html .= '<a class="btn btn-danger btn-sm" title="Delete Warehouse Type" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';
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

        return view('admin.warehouse_types.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.warehouse_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "warehouse_type_name" => "required|string|unique:warehouse_types,warehouse_type_name,NULL,id,deleted_at,NULL"
        ]);

        $warehouse_type_uid = get_random_id('warehouse_types', 'warehouse_type_uid');

        $warehouse_type = new WarehouseType();
        $warehouse_type->warehouse_type_uid = $warehouse_type_uid;
        $warehouse_type->warehouse_type_name = $request->warehouse_type_name;
        $warehouse_type->save();

        session()->flash('success', 'Warehouse Type has been created successfully !!');
        return redirect()->route('warehouse-types.index');
    }

    public function edit($id)
    {
        $warehouse_type = WarehouseType::find($id);

        if (is_null($warehouse_type)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('warehouse-types.index');
        }

        return view('admin.warehouse_types.edit', compact('warehouse_type'));
    }

    public function update(Request $request, $id)
    {
        $warehouse_type = WarehouseType::find($id);

        if (is_null($warehouse_type)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('warehouse-types.index');
        }

        $request->validate([
            'warehouse_type_name' => "required|string|unique:warehouse_types,warehouse_type_name,{$warehouse_type->id},id,deleted_at,NULL",
        ]);

        $warehouse_type->warehouse_type_name = $request->warehouse_type_name;
        $warehouse_type->save();

        session()->flash('success', 'Warehouse Type has been updated successfully !!');
        return redirect()->route('warehouse-types.index');
    }

    public function destroy($id)
    {
        $warehouse_type = WarehouseType::find($id);

        if (is_null($warehouse_type)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('warehouse-types.index');
        }

        //check warehouse_type deletable 
        $deletable = $this->check_warehouse_type_deletable($warehouse_type->warehouse_type_uid);
        if (!$deletable) {
            session()->flash('error', "Warehouse Type is already in use!");
            return redirect()->route('warehouse-types.index');
        }

        $warehouse_type->deleted_by = auth()->id();
        $warehouse_type->save();

        // Delete Warehouse Type
        $warehouse_type->delete();

        session()->flash('success', 'Warehouse Type has been deleted permanently !!');
        return redirect()->route('warehouse-types.index');
    }

    public function check_warehouse_type_deletable($warehouse_type_uid)
    {
        $user_procurements = UserProcurement::where('warehouse_type_uid', $warehouse_type_uid)->get();
        if (count($user_procurements) > 0) {
            return false;
        }
        return true;
    }
}
