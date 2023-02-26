<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BatchController extends Controller
{
    public function index()
    {
        $datas = Batch::orderBy('id', 'desc')->get();
        return view('admin.batch.index', compact('datas'));
    }

    public function create()
    {
        $Feedback = Batch::get();
        return view('admin.batch.create', compact('Feedback'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required',
            'startDate' => 'required',
            'startTime' => 'required',
            'description' => 'required',
            'image'  => 'required',
        ]);
        try {
            $batch = new Batch();
            $batch->title = $request->title;
            $batch->startDate = $request->startDate;
            $batch->startTime = $request->startTime;
            $batch->description = $request->description;
            
  




             if($request->hasfile('image')){
                $name = rand().'.'.$request->file('image')->extension();
                $request->file('image')->move(public_path('uploads/property'), $name);  
                $batch->image = $name;
             }



            $batch->save();
             session()->flash('success', 'Batch has been created successfully !!');
            return redirect()->route('batch.index');
        } catch (\Exception $e) {
            print_r($e);
            die;

            session()->flash('sticky_error', $e->getMessage());
            
            return back();
        }
    }

    public function edit($id)
    {
        $batch = Batch::find($id);

        if (is_null($batch)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('batch.index');
        }
        return view('admin.batch.edit', compact('batch'));
    }

    public function update(Request $request, $id)
    {
        $batch = Batch::find($id);
         

        if (is_null($batch)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('batch.index');
        }

        $request->validate([
            'title' => 'required',
            'startDate' => 'required',
            'startTime' => 'required',
            'description' => 'required',
            
        ]);

        try {
            $batch->title = $request->title;
            $batch->startDate = $request->startDate;
            $batch->startTime = $request->startTime;
            $batch->description = $request->description;

            if($request->hasfile('image')){
                $name = rand().'.'.$request->file('image')->extension();
                $request->file('image')->move(public_path('uploads/property'), $name);  
                $batch->image = $name;
             }
            
             $batch->save();
            session()->flash('success', 'Batch has been updated successfully !!');
            return redirect()->route('batch.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            return back();
        }
    }

    public function destroy($id)
    {
        $batch = Batch::find($id);

        if (is_null($batch)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('batch.index');
        }
        // Remove Image
         

        

        // Delete fpo
        $batch->deleted_by = auth()->id();
        $batch->save();
        $batch->delete();

        session()->flash('success', 'Testimonial has been deleted permanently !!');
        return redirect()->route('batch.index');
    }

    public function fpoKycList()
    {
        $datas = User::where('user_type', 'fpo')->where('address_document_id_number', '!=', null)->get();;

        // if (request()->ajax()) {
        //     $batch_kycs = User::where('user_type', 'fpo')->where(function ($query) {
        //         $query->where('aadhar_number', '!=', null)
        //             ->orWhere('account_number', '!=', null)
        //             ->orWhere('address_document_id_number', '!=', null);
        //     })->get();;

        //     $datatable = DataTables::of($batch_kycs)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $html = '';
        //                 if ($row->kyc_status == 'pending') {
        //                     $html .= '<button class="btn btn-info btn-sm me-3 viewOrActionKyc" title="Approve / Reject KYC" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#kycModal">Approve/Reject</button>';
        //                 } else if ($row->kyc_status == 'accepted') {
        //                     $html .= '<button class="btn btn-info btn-sm me-3 viewOrActionKyc" title="View KYC" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#kycModal">View</button>';
        //                 } else if ($row->kyc_status == 'rejected') {
        //                     $html .= '<button class="btn btn-info btn-sm me-3 viewOrActionKyc" title="View KYC" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#kycModal">View</button>';
        //                 }

        //                 return $html;
        //             }
        //         )

        //         ->editColumn('created_at', function ($row) {
        //             return $row->created_at ? $row->created_at->format('d/m/Y') : '';
        //         })
        //         ->editColumn('kyc_name', function ($row) {
        //             return $row->company_name;
        //         })
        //         ->editColumn('mobile_number', function ($row) {
        //             return $row->mobile_number;
        //         })
        //         ->editColumn('kyc_status', function ($row) {
        //             if ($row->kyc_status == 'pending') {
        //                 return '<span class="badge bg-gradient-blooker text-white shadow-sm w-100">Pending</span>';
        //             } else if ($row->kyc_status == 'accepted') {
        //                 return '<span class="badge bg-gradient-quepal text-white shadow-sm w-100">Accepted</span>';
        //             } else if ($row->kyc_status == 'rejected') {
        //                 return '<span class="badge bg-gradient-bloody text-white shadow-sm w-100">Rejected</span>';
        //             } else {
        //                 return '';
        //             }
        //             return $row->kyc_status;
        //         });
        //     $rawColumns = ['action', 'created_at', 'kyc_name', 'mobile_number', 'kyc_status'];
        //     return $datatable->rawColumns($rawColumns)
        //         ->make(true);
        // }

        return view('admin.kycs.fpo-kycs', compact('datas'));
    }

    public function getFpoKycById(Request $request)
    {
        $data = [];
        $batch = User::where('id', $request->user_id)->first();
        if ($batch) {
            $data = [
                'id' => $batch->id,
                'company_name' => $batch->company_name,
                'mobile_number' => $batch->mobile_number,
                'gst_number' => $batch->gst_number,
                'account_number' => $batch->account_number,
                'account_holder_name' => $batch->account_holder_name,
                'ifsc_code' => $batch->ifsc_code,
                'bank_name' => $batch->bank_name,
                'branch_name' => $batch->branch_name,
                'address_document_type' => $batch->address_document_type,
                'address_document_id_number' => $batch->address_document_id_number,
                'kyc_status' => $batch->kyc_status,
                'gst_document' => $batch->gst_document ? get_file_from_aws($batch->gst_document) : '',
                'gst_file_name' => substr(html_entity_decode($batch->gst_document), 0, 20) . '...',
                'gst_upload_date' => $batch->gst_upload_date ? $batch->gst_upload_date->format('d/m/Y h:i A') : '',
                'bank_document' => $batch->bank_document ? get_file_from_aws($batch->bank_document) : '',
                'bank_file_name' => substr(html_entity_decode($batch->bank_document), 0, 20) . '...',
                'bank_upload_date' => $batch->bank_upload_date ? $batch->bank_upload_date->format('d/m/Y h:i A') : '',
                'address_document' => $batch->address_document ? get_file_from_aws($batch->address_document) : '',
                'address_file_name' => substr(html_entity_decode($batch->address_document), 0, 20) . '...',
                'address_upload_date' => $batch->address_upload_date ? $batch->address_upload_date->format('d/m/Y h:i A') : '',
            ];
        }
        return response()->json(['success' => true, 'message' => 'User KYC details get!', 'data' => $data], 200);
    }
    public function updateFpoKycStatus(Request $request)
    {
        switch ($request->action) {
            case 'delete':
                $batch = User::where('id', $request->user_id)->first();
                if ($batch) {
                    UploadHelper::deleteFile('assets/uploaded_images/documents/users/' . $batch->gst_document);
                    UploadHelper::deleteFile('assets/uploaded_images/documents/users/' . $batch->bank_document);
                    UploadHelper::deleteFile('assets/uploaded_images/documents/users/' . $batch->address_document);
                    $batch->update([
                        'kyc_status' => null,
                        'gst_document' => null,
                        'bank_document' => null,
                        'address_document' => null,
                    ]);
                }
                break;
            case 'reject':
                $batch = User::where('id', $request->user_id)->first();
                if ($batch) {
                    $batch->update(['kyc_status' => 'rejected']);
                }
                break;
            case 'accept':
                $batch = User::where('id', $request->user_id)->first();
                if ($batch) {
                    $batch->update(['kyc_status' => 'accepted']);
                }
                break;
        }
        return response()->json(['success' => true, 'message' => 'User KYC status updated!',], 200);
    }
}
