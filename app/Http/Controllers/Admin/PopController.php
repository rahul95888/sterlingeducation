<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Commodity;
use App\Models\Pop;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PopController extends Controller
{
    public function index()
    {
        $datas = Pop::orderBy('id', 'desc')->get();
        return view('admin.pops.index',compact('datas'));
    }

    public function create(){
        return view('admin.pops.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'image'  => 'nullable|file|mimes:jpg,png,jpeg,bmp',
            ],
           
        );
         
         
        
        try {
            DB::beginTransaction();
            $pop = new Pop();
            if (!is_null($request->image)) {
                $imageName = time().'.'.$request->file('image')->extension();
                request()->image->move(public_path('uploads/property'), $imageName);
                $pop->image  =   $imageName;
            }
            $pop->save();
            DB::commit();
            session()->flash('success', 'Slider has been created successfully !!');
            return redirect()->route('pops.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function edit($id)
    {
        $pop = Pop::find($id);

        if (is_null($pop)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('pops.index');
        }
       
        return view('admin.pops.edit', compact('pop'));
    }

    public function update(Request $request, $id)
    {
        $pop = Pop::find($id);

        if (is_null($pop)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('pops.index');
        }

        $request->validate(
            [
                
                'image'  => 'nullable|image',
            ],
             
        );
         
        try {
            DB::beginTransaction();
            
             
            if($request->hasfile('image')){
                $name = rand().'.'.$request->file('image')->extension();
                $request->file('image')->move(public_path('uploads/property'), $name);  
                $pop->image = $name;
             }
            $pop->save();
            DB::commit();
            session()->flash('success', 'Slider has been updated successfully !!');
            return redirect()->route('pops.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function destroy($id)
    {
        $pop = Pop::find($id);

        if (is_null($pop)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('pops.index');
        }
        // Remove Image
        UploadHelper::deleteFile('assets/uploaded_images/pops/' . $pop->image);

        $pop->deleted_by = auth()->id();
        $pop->save();

        // Delete Pop
        $pop->delete();

        session()->flash('success', 'Slider has been deleted permanently !!');
        return redirect()->route('pops.index');
    }
}
