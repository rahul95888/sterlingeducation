<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commodity;
use App\Models\ProcessMethod;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProcessMethodController extends Controller
{
    public function index()
    {
        $datas = ProcessMethod::orderBy('id', 'desc')->get();
        // if (request()->ajax()) {
        //     $process_methods = ProcessMethod::with('commodity')->select('process_methods.*');

        //     $datatable = DataTables::of($process_methods)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $csrf = "" . csrf_field() . "";
        //                 $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 $deleteRoute =  route('process-methods.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" title="Edit Process Method Details" href="' . route('process-methods.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 $html .= '<a class="btn btn-danger btn-sm" title="Delete Process Method" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';
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

        return view('admin.process-methods.index', compact('datas'));
    }

    public function create()
    {
        $commodities = Commodity::all();
        return view('admin.process-methods.create', compact('commodities'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'process_method_name'  => 'required|string',
                'commodity_uid'  => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
            ],
            [
                'commodity_uid.required' => 'Commodity is required!',
                'commodity_uid.exists' => "Commodity doesn't exists!"
            ]
        );

        $is_process_method = ProcessMethod::where('commodity_uid', $request->commodity_uid)->where('process_method_name', $request->process_method_name)->first();
        if ($is_process_method) {
            return redirect()->back()->withInput($request->input())->with('sticky_error', "The process method name has already been taken.");
        }

        $process_method_uid = get_random_id('process_methods', 'process_method_uid');

        $process_method = new ProcessMethod();
        $process_method->process_method_uid = $process_method_uid;
        $process_method->process_method_name = $request->process_method_name;
        $process_method->commodity_uid = $request->commodity_uid;
        $process_method->save();

        session()->flash('success', 'Process Method has been created successfully !!');
        return redirect()->route('process-methods.index');
    }

    public function edit($id)
    {
        $process_method = ProcessMethod::find($id);

        if (is_null($process_method)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('process-methods.index');
        }
        $commodities = Commodity::all();
        return view('admin.process-methods.edit', compact('process_method', 'commodities'));
    }

    public function update(Request $request, $id)
    {
        $process_method = ProcessMethod::find($id);

        if (is_null($process_method)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('process-methods.index');
        }

        $request->validate(
            [
                'process_method_name'  => 'required|string',
                'commodity_uid'  => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
            ],
            [
                'commodity_uid.required' => 'Commodity is required!',
                'commodity_uid.exists' => "Commodity doesn't exists!"
            ]
        );

        $is_process_method = ProcessMethod::where('commodity_uid', $request->commodity_uid)->where('process_method_name', $request->process_method_name)->where('id', '<>', $id)->first();
        if ($is_process_method) {
            return redirect()->back()->withInput($request->input())->with('sticky_error', "The process method name has already been taken.");
        }

        $process_method->process_method_name = $request->process_method_name;
        $process_method->commodity_uid = $request->commodity_uid;
        $process_method->save();

        session()->flash('success', 'Process Method has been updated successfully !!');
        return redirect()->route('process-methods.index');
    }

    public function destroy($id)
    {
        $process_method = ProcessMethod::find($id);

        if (is_null($process_method)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('process-methods.index');
        }

        $process_method->deleted_by = auth()->id();
        $process_method->save();

        // Delete ProcessMethod
        $process_method->delete();

        session()->flash('success', 'Process Method has been deleted permanently !!');
        return redirect()->route('process-methods.index');
    }
}
