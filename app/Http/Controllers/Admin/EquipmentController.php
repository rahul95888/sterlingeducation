<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EquipmentController extends Controller
{
    public function index()
    {
        $datas = Equipment::get();
        

        return view('admin.equipments.index',compact('datas'));
    }

    public function create()
    {
        return view('admin.equipments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "equipment_name" => "required|string|unique:equipments,equipment_name,NULL,id,deleted_at,NULL",
        ]);

        $equipment_uid = get_random_id('equipments', 'equipment_uid');

        $equipment = new Equipment();
        $equipment->equipment_uid = $equipment_uid;
        $equipment->equipment_name = $request->equipment_name;
        $equipment->description = $request->description ?? null;
        $equipment->save();

        session()->flash('success', 'Equipment has been created successfully !!');
        return redirect()->route('equipments.index');
    }

    public function edit($id)
    {
        $equipment = Equipment::find($id);

        if (is_null($equipment)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('equipments.index');
        }

        return view('admin.equipments.edit', compact('equipment'));
    }

    public function update(Request $request, $id)
    {
        $equipment = Equipment::find($id);

        if (is_null($equipment)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('equipments.index');
        }

        $request->validate([
            'equipment_name' => "required|string|unique:equipments,equipment_name,{$equipment->id},id,deleted_at,NULL",
        ]);

        $equipment->equipment_name = $request->equipment_name;
        $equipment->description = $request->description ?? null;
        $equipment->save();

        session()->flash('success', 'Equipment has been updated successfully !!');
        return redirect()->route('equipments.index');
    }

    public function destroy($id)
    {
        $equipment = Equipment::find($id);

        if (is_null($equipment)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('equipments.index');
        }

        $equipment->deleted_by = auth()->id();
        $equipment->save();

        // Delete Equipment
        $equipment->delete();

        session()->flash('success', 'Equipment has been deleted permanently !!');
        return redirect()->route('equipments.index');
    }
}
