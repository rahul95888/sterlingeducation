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
use App\Models\User;
use App\Models\Feedback;
use App\Models\State;
use App\Models\SubDistrict;
use App\Models\Village;
use App\Models\WarehouseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FpoController extends Controller
{
    public function index()
    {
        $datas = Feedback::orderBy('id', 'desc')->get();
        return view('admin.fpos.index', compact('datas'));
    }

    public function create()
    {
        
       
        
        $Feedback = Feedback::get();

        return view('admin.fpos.create', compact('Feedback'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'feedback_uid' => 'required',
            'rate' => 'required',
        ]);

        try {
            

           
            $fpo = new Feedback();
            
            $fpo->feedback_uid = $request->feedback_uid;
            $fpo->rate = $request->rate;
            $fpo->message = $request->message;
            

            if($request->hasfile('image')){
                $name = rand().'.'.$request->file('image')->extension();
                $request->file('image')->move(public_path('uploads/property'), $name);  
                $fpo->image = $name;
             }
             $fpo->save();
             session()->flash('success', 'Testimonial has been created successfully !!');
            return redirect()->route('fpos.index');
        } catch (\Exception $e) {
            print_r($e);
            die;

            session()->flash('sticky_error', $e->getMessage());
            
            return back();
        }
    }

    public function edit($id)
    {
        $data = Feedback::find($id);

        if (is_null($data)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('fpos.index');
        }
         
        
       
        
        
       
        return view('admin.fpos.edit', compact('data' ));
    }

    public function update(Request $request, $id)
    {
        $fpo = Feedback::find($id);
         

        if (is_null($fpo)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('fpos.index');
        }

        $request->validate([
            'feedback_uid' => 'required',
            'rate' => 'required',
        ]);

        try {
            $fpo->feedback_uid = $request->feedback_uid;
            $fpo->rate = $request->rate;
            $fpo->message = $request->message;

            if($request->hasfile('image')){
                $name = rand().'.'.$request->file('image')->extension();
                $request->file('image')->move(public_path('uploads/property'), $name);  
                $fpo->image = $name;
             }
             $fpo->save();
            session()->flash('success', 'Testimonial has been updated successfully !!');
            return redirect()->route('fpos.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            return back();
        }
    }

    public function destroy($id)
    {
        $fpo = Feedback::find($id);

        if (is_null($fpo)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('fpos.index');
        }
        // Remove Image
         

        

        // Delete fpo
        $fpo->deleted_by = auth()->id();
        $fpo->save();
        $fpo->delete();

        session()->flash('success', 'Testimonial has been deleted permanently !!');
        return redirect()->route('fpos.index');
    }

    public function fpoKycList()
    {
        $datas = User::where('user_type', 'fpo')->where(function ($query) {
            $query->where('gst_number', '!=', null)
                ->orWhere('account_number', '!=', null)
                ->orWhere('address_document_id_number', '!=', null);
        })->get();;

        // if (request()->ajax()) {
        //     $fpo_kycs = User::where('user_type', 'fpo')->where(function ($query) {
        //         $query->where('aadhar_number', '!=', null)
        //             ->orWhere('account_number', '!=', null)
        //             ->orWhere('address_document_id_number', '!=', null);
        //     })->get();;

        //     $datatable = DataTables::of($fpo_kycs)
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
        $fpo = User::where('id', $request->user_id)->first();
        if ($fpo) {
            $data = [
                'id' => $fpo->id,
                'company_name' => $fpo->company_name,
                'mobile_number' => $fpo->mobile_number,
                'gst_number' => $fpo->gst_number,
                'account_number' => $fpo->account_number,
                'account_holder_name' => $fpo->account_holder_name,
                'ifsc_code' => $fpo->ifsc_code,
                'bank_name' => $fpo->bank_name,
                'branch_name' => $fpo->branch_name,
                'address_document_type' => $fpo->address_document_type,
                'address_document_id_number' => $fpo->address_document_id_number,
                'kyc_status' => $fpo->kyc_status,
                'gst_document' => $fpo->gst_document ? get_file_from_aws($fpo->gst_document) : '',
                'gst_file_name' => substr(html_entity_decode($fpo->gst_document), 0, 20) . '...',
                'gst_upload_date' => $fpo->gst_upload_date ? $fpo->gst_upload_date->format('d/m/Y h:i A') : '',
                'bank_document' => $fpo->bank_document ? get_file_from_aws($fpo->bank_document) : '',
                'bank_file_name' => substr(html_entity_decode($fpo->bank_document), 0, 20) . '...',
                'bank_upload_date' => $fpo->bank_upload_date ? $fpo->bank_upload_date->format('d/m/Y h:i A') : '',
                'address_document' => $fpo->address_document ? get_file_from_aws($fpo->address_document) : '',
                'address_file_name' => substr(html_entity_decode($fpo->address_document), 0, 20) . '...',
                'address_upload_date' => $fpo->address_upload_date ? $fpo->address_upload_date->format('d/m/Y h:i A') : '',
            ];
        }
        return response()->json(['success' => true, 'message' => 'User KYC details get!', 'data' => $data], 200);
    }
    public function updateFpoKycStatus(Request $request)
    {
        switch ($request->action) {
            case 'delete':
                $fpo = User::where('id', $request->user_id)->first();
                if ($fpo) {
                    UploadHelper::deleteFile('assets/uploaded_images/documents/users/' . $fpo->gst_document);
                    UploadHelper::deleteFile('assets/uploaded_images/documents/users/' . $fpo->bank_document);
                    UploadHelper::deleteFile('assets/uploaded_images/documents/users/' . $fpo->address_document);
                    $fpo->update([
                        'kyc_status' => null,
                        'gst_document' => null,
                        'bank_document' => null,
                        'address_document' => null,
                    ]);
                }
                break;
            case 'reject':
                $fpo = User::where('id', $request->user_id)->first();
                if ($fpo) {
                    $fpo->update(['kyc_status' => 'rejected']);
                }
                break;
            case 'accept':
                $fpo = User::where('id', $request->user_id)->first();
                if ($fpo) {
                    $fpo->update(['kyc_status' => 'accepted']);
                }
                break;
        }
        return response()->json(['success' => true, 'message' => 'User KYC status updated!',], 200);
    }
}
