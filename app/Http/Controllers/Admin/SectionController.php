<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pop;
use App\Models\Section;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SectionController extends Controller
{
    public function index()
    {
        $datas = Section::orderBy('id', 'desc')->get();
        // if (request()->ajax()) {
        //     $sections = Section::orderBy('id', 'desc')->get();

        //     $datatable = DataTables::of($sections)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $csrf = "" . csrf_field() . "";
        //                 $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 $deleteRoute =  route('sections.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" title="Edit Section Details" href="' . route('sections.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 $html .= '<a class="btn btn-danger btn-sm" title="Delete Section" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';
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
        //         // ->editColumn('id', function ($row) {
        //         //     return $row->id;
        //         // })
        //         ->editColumn('name', function ($row) {
        //             return $row->name;
        //         });
        //     $rawColumns = ['action', 'name'];
        //     return $datatable->rawColumns($rawColumns)
        //         ->make(true);
        // }

        return view('admin.sections.index',compact('datas'));
    }

    public function create()
    {
        return view('admin.sections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string'
        ]);

        $exist = Section::where('name', $request['name'])->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['name' => 'This section name already exists!'])->withInput();
        }

        $section_uid = get_random_id('sections', 'section_uid');

        $section = new Section();
        $section->section_uid = $section_uid;
        $section->name = $request->name;
        $section->section_content = $request->section_content ?? null;
        $section->save();

        session()->flash('success', 'Section has been created successfully !!');
        return redirect()->route('sections.index');
    }

    public function edit($id)
    {
        $section = Section::find($id);

        if (is_null($section)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('sections.index');
        }

        return view('admin.sections.edit', compact('section'));
    }

    public function update(Request $request, $id)
    {
        $section = Section::find($id);

        if (is_null($section)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('sections.index');
        }

        $request->validate([
            'name'  => 'required|string'
        ]);

        $exist = Section::where('name', $request['name'])->where('section_uid', '!=', $section->section_uid)->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['name' => 'This section name already exists!'])->withInput();
        }

        $section->name = $request->name;
        $section->section_content = $request->section_content ?? null;
        $section->save();

        session()->flash('success', 'Section has been updated successfully !!');
        return redirect()->route('sections.index');
    }

    public function destroy($id)
    {
        $section = Section::find($id);

        if (is_null($section)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('sections.index');
        }

        //check section deletable 
        $deletable = $this->check_section_deletable($section->section_uid);
        if (!$deletable) {
            session()->flash('error', "Section is already in use!");
            return redirect()->route('sections.index');
        }

        $section->deleted_by = auth()->id();
        $section->save();

        // Delete Section
        $section->delete();

        session()->flash('success', 'Section has been deleted permanently !!');
        return redirect()->route('sections.index');
    }

    public function check_section_deletable($section_uid)
    {
        $pops = Pop::where('section_uid', $section_uid)->get();
        if (count($pops) > 0) {
            return false;
        }
        return true;
    }
}
