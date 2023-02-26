<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MockTest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MockTestController extends Controller
{
    public function index()
    {
        $datas = MockTest::get();
         

        return view('admin.mocktest.index',compact('datas'));
    }

    public function create()
    {
        return view('admin.mocktest.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required",
            "amount" => "required",
            "url" => "required",
            "description" => "required",
            'slug' => 'required|alpha_dash|string|unique:mocktest,deleted_at,NULL',
        ]);

        

        $mocktest = new MockTest();
     
        $mocktest->title = $request->title;
        $mocktest->description = $request->description ?? null;
        $mocktest->amount = $request->amount ?? null;
        $mocktest->url = $request->url ?? null;
        
        $mocktest->slug = $request->slug;
        $mocktest->meta_title = $request->meta_title;
        $mocktest->meta_keyword = $request->meta_keyword;
        $mocktest->meta_description = $request->meta_description;

        
        if($request->hasfile('thumb')){
            $name = rand().'.'.$request->file('thumb')->extension();
            $request->file('thumb')->move(public_path('uploads/property'), $name);  
            $mocktest->thumb = $name;
         }


        $mocktest->save();

        session()->flash('success', 'Mocktest has been created successfully !!');
        return redirect()->route('mocktest.index');
    }

    public function edit($id)
    {
        $mocktest = MockTest::find($id);

        if (is_null($mocktest)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('mocktest.index');
        }

        return view('admin.mocktest.edit', compact('mocktest'));
    }

    public function update(Request $request, $id)
    {
        $mocktest = MockTest::find($id);

        if (is_null($mocktest)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('mocktest.index');
        }

        $request->validate([
            "title" => "required",
            "amount" => "required",
            "url" => "required",
            "description" => "required",
            'slug' => "required|alpha_dash|unique:mocktest,slug,$id",
        ]);


        $mocktest->title = $request->title;
        
        $mocktest->slug = $request->slug;
        $mocktest->meta_title = $request->meta_title;
        $mocktest->meta_keyword = $request->meta_keyword;
        $mocktest->meta_description = $request->meta_description;
        $mocktest->description = $request->description ?? null;
        $mocktest->amount = $request->amount ?? null;
        $mocktest->url = $request->url ?? null;

        if($request->hasfile('thumb')){
            $name = rand().'.'.$request->file('thumb')->extension();
            $request->file('thumb')->move(public_path('uploads/property'), $name);  
            $mocktest->thumb = $name;
         }


        $mocktest->save();

        session()->flash('success', 'MockTest has been updated successfully !!');
        return redirect()->route('mocktest.index');
    }

    public function destroy($id)
    {
        $mocktest = MockTest::find($id);

        if (is_null($mocktest)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('mocktest.index');
        }

        $mocktest->deleted_by = auth()->id();
        $mocktest->save();

        // Delete Equipment
        $mocktest->delete();

        session()->flash('success', 'Equipment has been deleted permanently !!');
        return redirect()->route('mocktest.index');
    }
}
