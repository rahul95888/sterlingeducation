<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commodity;
use App\Models\ProcessCapability;
use App\Models\UserCropDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProcessCapabilityController extends Controller
{
    public function index()
    {
        $datas = ProcessCapability::orderBy('id', 'desc')->get();
        return view('admin.process-capabilities.index', compact('datas'));
    }

    public function create()
    {
        $commodities = Commodity::all();
        return view('admin.process-capabilities.create', compact('commodities'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'process_capability_name'  => 'required|string',
                'commodity_uid'  => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
            ],
            [
                'commodity_uid.required' => 'Commodity is required!',
                'commodity_uid.exists' => "Commodity doesn't exists!"
            ]
        );
        $is_process_capability = ProcessCapability::where('commodity_uid', $request->commodity_uid)->where('process_capability_name', $request->process_capability_name)->first();
        if ($is_process_capability) {
            return redirect()->back()->withInput($request->input())->with('sticky_error', "The process capability name has already been taken.");
        }
        $process_capability_uid = get_random_id('process_capabilities', 'process_capability_uid');

        $process_capability = new ProcessCapability();
        $process_capability->process_capability_uid = $process_capability_uid;
        $process_capability->process_capability_name = $request->process_capability_name;
        $process_capability->commodity_uid = $request->commodity_uid;
        $process_capability->save();

        session()->flash('success', 'Process Capability has been created successfully !!');
        return redirect()->route('process-capabilities.index');
    }

    public function edit($id)
    {
        $process_capability = ProcessCapability::find($id);

        if (is_null($process_capability)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('process-capabilities.index');
        }
        $commodities = Commodity::all();
        return view('admin.process-capabilities.edit', compact('process_capability', 'commodities'));
    }

    public function update(Request $request, $id)
    {
        $process_capability = ProcessCapability::find($id);

        if (is_null($process_capability)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('process-capabilities.index');
        }

        $request->validate(
            [
                'process_capability_name'  => 'required|string',
                'commodity_uid'  => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
            ],
            [
                'commodity_uid.required' => 'Commodity is required!',
                'commodity_uid.exists' => "Commodity doesn't exists!"
            ]
        );

        $is_process_capability = ProcessCapability::where('commodity_uid', $request->commodity_uid)->where('process_capability_name', $request->process_capability_name)->where('id', '<>', $id)->first();
        if ($is_process_capability) {
            return redirect()->back()->withInput($request->input())->with('sticky_error', "The process capability name has already been taken.");
        }

        $process_capability->process_capability_name = $request->process_capability_name;
        $process_capability->commodity_uid = $request->commodity_uid;
        $process_capability->save();

        session()->flash('success', 'Process Capability has been updated successfully !!');
        return redirect()->route('process-capabilities.index');
    }

    public function destroy($id)
    {
        $process_capability = ProcessCapability::find($id);

        if (is_null($process_capability)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('process-capabilities.index');
        }

        $process_capability->deleted_by = auth()->id();
        $process_capability->save();

        // Delete Process Capability
        $process_capability->delete();

        session()->flash('success', 'Process Capability has been deleted permanently !!');
        return redirect()->route('process-capabilities.index');
    }
}
