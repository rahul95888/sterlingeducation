<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Commodity;
use App\Models\Country;
use App\Models\District;
use App\Models\Education;
use App\Models\Pincode;
use App\Models\City;
use App\Models\ProcessCapability;
use App\Models\ProcessMethod;
use App\Models\Equipment;

use App\Models\State;
use App\Models\SubDistrict;
use App\Models\Village;
use App\Models\WarehouseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Gallery;
class ProcessorController extends Controller
{
    public function index()
    {
        $datas = Equipment::orderBy('id', 'desc')->get();
        return view('admin.processors.index', compact('datas'));
    }

    public function create(){
        return view('admin.processors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipment_name' => 'required|string',
            'description' => 'required|string',
            // "slug" => "required|alpha_dash|string|unique:equipments,slug,NULL",

            'slug' => 'required|alpha_dash|string|unique:equipments,deleted_at,NULL',

        ]);
        try {
            DB::beginTransaction();
            $shop = new Equipment();
            $shop->equipment_name = $request->equipment_name;
            $shop->slug = $request->slug;
            $shop->itinerary = $request->itinerary;
            $shop->description = $request->description;
            $shop->google_location = isset($request->google_location) ? $request->google_location : '';
            $shop->video = isset($request->video) ? $request->video : '';

            $shop->total_area = isset($request->total_area) ? $request->total_area : '';
            $shop->belcony_pets = isset($request->belcony_pets) ? $request->belcony_pets : '';
            $shop->bedroom = isset($request->bedroom) ? $request->bedroom : '';
            $shop->lounge = isset($request->lounge) ? $request->lounge : '';

             
            $shop->bathroom = isset($request->bathroom) ? $request->bathroom : '';
            $shop->gym_area = isset($request->gym_area) ? $request->gym_area : '';
            $shop->parking = isset($request->parking) ? $request->parking : '';

            $shop->property_for = isset($request->property_for) ? $request->property_for : '';
            $shop->status = isset($request->status) ? $request->status : '';

            if($request->hasfile('thumb')){
                $name = rand().'.'.$request->file('thumb')->extension();
                $request->file('thumb')->move(public_path('uploads/property'), $name);  
                $shop->thumb = $name;
             }
            $shop->save();
            
         DB::commit();
            session()->flash('success', 'Processor has been created successfully !!');
            return redirect()->route('processors.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function edit($id)
{
    $shop = Equipment::find($id);

    if (is_null($shop)) {
        session()->flash('error', "The page is not found !");
        return redirect()->route('processors.index');
    }
  
    return view('admin.processors.edit', compact('shop'));
}

public function update(Request $request, $id)
    {
        $shop = Equipment::find($id);
        if (is_null($shop)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('processors.index');
        }  

        $request->validate([
            'equipment_name' => 'required|string',
            'description' => 'required|string',
            'slug' => "required|alpha_dash|unique:equipments,slug,$id",



            

        ]);

        
            $shop->equipment_name = $request->equipment_name;
            $shop->slug = $request->slug;
            $shop->itinerary = $request->itinerary;
            $shop->description = $request->description;
            $shop->google_location = isset($request->google_location) ? $request->google_location : '';
            $shop->video = isset($request->video) ? $request->video : '';
            $shop->total_area = isset($request->total_area) ? $request->total_area : '';
            $shop->belcony_pets = isset($request->belcony_pets) ? $request->belcony_pets : '';
            $shop->bedroom = isset($request->bedroom) ? $request->bedroom : '';
            $shop->lounge = isset($request->lounge) ? $request->lounge : '';
            $shop->bathroom = isset($request->bathroom) ? $request->bathroom : '';
            $shop->gym_area = isset($request->gym_area) ? $request->gym_area : '';
            $shop->parking = isset($request->parking) ? $request->parking : '';
            $shop->property_for = isset($request->property_for) ? $request->property_for : '';
            $shop->status = isset($request->status) ? $request->status : '';
            if($request->hasfile('thumb')){
                $name = rand().'.'.$request->file('thumb')->extension();
                $request->file('thumb')->move(public_path('uploads/property'), $name);  
                $shop->thumb = $name;
             }
            $shop->save();
       

        

        

        session()->flash('success', 'Package has been deleted permanently !!');
        return redirect()->route('processors.index');
    }
   
    

     
    public function destroy($id)
    {
        $fpo = Equipment::find($id);

        if (is_null($fpo)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('downloads.index');
        }
        // Remove Image
         

        

       
        $fpo->delete();

        session()->flash('success', 'Course has been deleted permanently !!');
        return back();
    }

    
}

