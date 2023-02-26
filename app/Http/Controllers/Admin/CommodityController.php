<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Commodity;
use App\Models\News;
use App\Models\Pop;
use App\Models\ProcessCapability;
use App\Models\ProcessMethod;
use App\Models\Service;
use App\Models\Trade;
use App\Models\UserCropDetail;
use App\Models\Variety;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CommodityController extends Controller
{
    public function index()
    {
        $datas = Commodity::orderBy('id', 'desc')->get();
        // if (request()->ajax()) {
        //     $commodities = Commodity::select('commodities.*');

        //     $datatable = DataTables::of($commodities)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $csrf = "" . csrf_field() . "";
        //                 $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 $deleteRoute =  route('commodities.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" title="Edit Commodity Details" href="' . route('commodities.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 $html .= '<a class="btn btn-danger btn-sm" title="Delete Commodity" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';
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
        //         ->editColumn('image', function ($row) {
        //             if ($row->image != null) {
        //                 return "<img src='" . get_file_from_aws($row->image) . "' width='50' height='30'/>";
        //             }
        //             return '-';
        //         });
        //     $rawColumns = ['action', 'image'];
        //     return $datatable->rawColumns($rawColumns)->make(true);
        // }

        return view('admin.commodity.index',compact('datas'));
    }

    public function create()
    {
        return view('admin.commodity.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|unique:commodities,name,NULL,id,deleted_at,NULL",
             
        ]);

        try {
            DB::beginTransaction();

            $commodity_uid = get_random_id('commodities', 'commodity_uid');

            $commodity = new Commodity();
            $commodity->commodity_uid = $commodity_uid;
            $commodity->name = $request->name;

           
            $commodity->save();

            DB::commit();
            session()->flash('success', 'Commodity has been created successfully !!');
            return redirect()->route('commodities.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function edit($id)
    {
        $commodity = Commodity::find($id);

        if (is_null($commodity)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('commodities.index');
        }
        $varieties = Variety::all();
        return view('admin.commodity.edit', compact('commodity', 'varieties'));
    }

    public function update(Request $request, $id)
    {
        $commodity = Commodity::find($id);

        if (is_null($commodity)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('commodities.index');
        }

        $request->validate([
            'name' => "required|string|unique:commodities,name,{$commodity->id},id,deleted_at,NULL",
            
        ]);

        try {
            DB::beginTransaction();

            $commodity_uid = $commodity->commodity_uid;
            $commodity->name = $request->name;

             


            $commodity->save();
            DB::commit();
            session()->flash('success', 'Category has been updated successfully !!');
            return redirect()->route('commodities.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function destroy($id)
    {
        $commodity = Commodity::find($id);

        if (is_null($commodity)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('commodities.index');
        }
        //check commodity deletable
        $deletable = $this->check_commodity_deletable($commodity->commodity_uid);
        if (!$deletable) {
            session()->flash('error', "Commodity is already in use!");
            return redirect()->route('commodities.index');
        }
        // Remove Image
        UploadHelper::deleteFile('assets/uploaded_images/commodities/' . $commodity->image);

        $commodity->deleted_by = auth()->id();
        $commodity->save();

        // Delete Commodity
        $commodity->delete();

        session()->flash('success', 'Commodity has been deleted permanently !!');
        return redirect()->route('commodities.index');
    }
     
}
