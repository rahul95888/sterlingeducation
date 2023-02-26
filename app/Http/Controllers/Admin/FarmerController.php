<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Commodity;
use App\Models\Country;
use App\Models\District;
use App\Models\Education;
use App\Models\City;
use App\Models\Pincode;
use App\Models\User;

use App\Models\State;
use App\Models\SubDistrict;
use App\Models\Village;
use App\Models\WarehouseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FarmerController extends Controller
{
    public function index()
    {
        $datas = User::where('user_type', 'farmer')->orderBy('id', 'desc')->get();
 
        // if (request()->ajax()) {
        //     $farmers = User::where('user_type', 'farmer')->orderBy('id', 'desc')->get();

        //     $datatable = DataTables::of($farmers)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 //   $csrf = "" . csrf_field() . "";
        //                 //   $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 //  $deleteRoute =  route('farmers.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" title="Edit Farmer Details" href="' . route('farmers.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 //                        $html .= '<a class="btn btn-danger btn-sm" title="Delete Farmer" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';
        //                 //                        $delete_message = "You won't be able to revert this!";
        //                 //                        $html .= '<script>
        //                 //                            $("#deleteItem' . $row->id . '").click(function(){
        //                 //                                swal.fire({ title: "Are you sure?",text: "' . $delete_message . '",type: "warning",showCancelButton: true,confirmButtonColor: "#DD6B55",confirmButtonText: "Yes, delete it!"
        //                 //                                }).then((result) => { if (result.value) {$("#deleteForm' . $row->id . '").submit();}})
        //                 //                            });
        //                 //                        </script>';
        //                 //
        //                 //                        $html .= '
        //                 //                            <form id="deleteForm' . $row->id . '" action="' . $deleteRoute . '" method="post" style="display:none">' . $csrf . $method_delete . '
        //                 //                                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-success"><i
        //                 //                                        class="icofont icofont-check"></i> Confirm Delete</button>
        //                 //                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal"><i
        //                 //                                        class="fa fa-times"></i> Cancel</button>
        //                 //                            </form>';
        //                 return $html;
        //             }
        //         )
        //         ->editColumn('mobile_number', function ($row) {
        //             return $row->mobile_number;
        //         })
        //         ->editColumn('name', function ($row) {
        //             return $row->name;
        //         })
        //         ->editColumn('date_of_birth', function ($row) {
        //             return $row->date_of_birth ? $row->date_of_birth->format('d/m/Y') : '';
        //         })
        //         ->editColumn('registered_from', function ($row) {
        //             if ($row->registered_from == 'Admin') {
        //                 return '<span class="badge bg-success">Admin</span>';
        //             } else if ($row->registered_from == 'App') {
        //                 return '<span class="badge bg-warning">App</span>';
        //             } else {
        //                 return '';
        //             }
        //         });
        //     $rawColumns = ['action', 'mobile_number', 'name', 'date_of_birth', 'registered_from'];
        //     return $datatable->rawColumns($rawColumns)
        //         ->make(true);
        // }

        return view('admin.farmers.index', compact('datas'));
    }

    public function create()
    {
        $commodities = Commodity::with('varieties')->get();
       
        $countries = Country::get();
        $states = State::get();
        $districts = District::get();
        $sub_districts = SubDistrict::get();
        $villages = Village::get();
        $pincodes = Pincode::get();
        $cities = City::get();
        $warehouse_types = WarehouseType::get();

        return view('admin.farmers.create', compact('commodities',  'cities' ,'countries', 'states', 'districts', 'sub_districts', 'villages', 'pincodes', 'warehouse_types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mobile_number' => 'required|numeric|digits:10|unique:users,mobile_number,NULL,id,deleted_at,NULL',
            'name' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:male,female,other',
            'email' => 'nullable|string|unique:users,email,NULL,id,deleted_at,NULL',
            'education_uid' => 'nullable|string',
            'address' => 'required|string',
            'country_uid' => 'required|string|exists:countries,country_uid,deleted_at,NULL',
            'state_uid' => 'required|string|exists:states,state_uid,deleted_at,NULL',
            'city_uid' => 'required|string|exists:cities,city_uid,deleted_at,NULL',
            'district_uid' => 'required|string|exists:districts,district_uid,deleted_at,NULL',
            'sub_district_uid' => 'required|string|exists:sub_districts,sub_district_uid,deleted_at,NULL',
            'village_uid' => 'required|string|exists:villages,village_uid,deleted_at,NULL',
            'pincode_uid' => 'required|string|exists:pincodes,pincode_uid,deleted_at,NULL',
            
            'commodity_uid' => 'required|array|min:1',
            'variety_uid' => 'required|array|min:1',
            'acreage' => 'required|array|min:1',
            'primary_processing_method' => 'nullable|array|min:1',

            'aadhar_number' => 'nullable|string|min:12',
            'aadhar_document' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg',
            'account_number' => 'nullable|string',
            'account_holder_name' => 'nullable|string',
            'ifsc_code' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'branch_name' => 'nullable|string',
            'bank_document' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg',
            'address_document_type' => 'nullable|string',
            'address_document_id_number' => 'nullable|string',
            'address_document' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg',

            'warehouse_address' => 'nullable|array|min:1',
            'warehouse_capacity' => 'nullable|array|min:1',
            'warehouse_type_uid' => 'nullable|array|min:1',
            'procurement_states' => 'nullable|array|min:1',
            'procurement_districts' => 'nullable|array|min:1',
            'procurement_sub_districts' => 'nullable|array|min:1',
            'procurement_villages' => 'nullable|array|min:1',
        ], [
            'education_uid.required' => 'Education field is required!',
            'education_uid.exists' => "Education doesn't exists!",
            'country_uid.required' => 'Country is required!',
            'country_uid.exists' => "Country doesn't exists!",
            'state_uid.required' => 'State is required!',
            'state_uid.exists' => "State doesn't exists!",
            'city_uid.required' => 'City is required!',
            'city_uid.exists' => "City doesn't exists!",
            'district_uid.required' => 'District is required!',
            'district_uid.exists' => "District doesn't exists!",
            'sub_district_uid.required' => 'Sub District is required!',
            'sub_district_uid.exists' => "Sub District doesn't exists!",
            'village_uid.required' => 'Village is required!',
            'village_uid.exists' => "Village doesn't exists!",
            'pincode_uid.required' => 'Pincode is required!',
            'pincode_uid.exists' => "Pincode doesn't exists!",
            'commodity_uid.required' => 'Commodity is required!',
            'commodity_uid.exists' => "Commodity doesn't exists!",
            'variety_uid.required' => 'Variety is required!',
            'variety_uid.exists' => "Variety doesn't exists!",
        ]);

        try {
            DB::beginTransaction();

            $unique_user_id = get_random_id('users', 'unique_user_id');

            $farmer = new User();
            $farmer->unique_user_id = $unique_user_id;
            $farmer->mobile_number = $request->mobile_number;
            $farmer->name = $request->name;
            $farmer->date_of_birth = $request->date_of_birth;
            $farmer->gender = $request->gender;
            $farmer->email = $request->email ?? null;
            $farmer->education_uid = $request->education_uid ?? null;
            $farmer->address = $request->address;
            $farmer->country_uid = $request->country_uid;
            $farmer->state_uid = $request->state_uid;
            $farmer->city_uid = $request->city_uid;
            $farmer->district_uid = $request->district_uid;
            $farmer->sub_district_uid = $request->sub_district_uid;
            $farmer->village_uid = $request->village_uid;
            $farmer->pincode_uid = $request->pincode_uid;
            $farmer->aadhar_number = $request->aadhar_number ?? null;

            if (!is_null($request->aadhar_document)) {
                $keyName = $unique_user_id . '/' . env('KEY_AADHAR_DOCUMENT');
                $farmer->aadhar_document = file_upload_on_aws($request->aadhar_document, $keyName);
                $farmer->aadhar_upload_date = now();
            }

            $farmer->account_number = $request->account_number ?? null;
            $farmer->account_holder_name = $request->account_holder_name ?? null;
            $farmer->ifsc_code = $request->ifsc_code ?? null;
            $farmer->bank_name = $request->bank_name ?? null;
            $farmer->branch_name = $request->branch_name ?? null;

            if (!is_null($request->bank_document)) {
                $keyName = $unique_user_id . '/' . env('KEY_BANK_DOCUMENT');
                $farmer->bank_document = file_upload_on_aws($request->bank_document, $keyName);
                $farmer->bank_upload_date = now();
            }

            $farmer->address_document_type = $request->address_document_type ?? null;
            $farmer->address_document_id_number = $request->address_document_id_number ?? null;

            if (!is_null($request->address_document)) {
                $keyName = $unique_user_id . '/' . env('KEY_ADDRESS_DOCUMENT');
                $farmer->address_document = file_upload_on_aws($request->address_document, $keyName);
                $farmer->address_upload_date = now();
            }

            $farmer->registered_at = now();
            $farmer->registered_from = 'Admin';
            $farmer->kyc_status = 'accepted';
            $farmer->user_type = 'farmer';
            $farmer->save();

            $farmer->attachRole('farmer');

            // store farmer crop details
            $farmer_crop_details = [];
            foreach ($request->commodity_uid as $key => $commodity) {
                $user_crop_detail_uid = get_random_id('user_crop_details', 'user_crop_detail_uid');
                $new_crop = [
                    'user_crop_detail_uid' => $user_crop_detail_uid,
                    'commodity_uid' => $commodity,
                    'variety_uid' => isset($request->variety_uid) && isset($request->variety_uid[$key]) ? $request->variety_uid[$key] : null,
                    'acreage' => isset($request->acreage) && isset($request->acreage[$key])  ? $request->acreage[$key] : null,
                    'primary_processing_method' => isset($request->primary_processing_method)  && isset($request->primary_processing_method[$key]) ? $request->primary_processing_method[$key] : 0,
                ];
                array_push($farmer_crop_details, $new_crop);
            }
            $farmer->userCropDetails()->createMany($farmer_crop_details);

            // store farmer procurements
            if (isset($request->warehouse_address) && !in_array(null, $request->warehouse_address)) {
                $farmer_procurements = [];
                foreach ($request->warehouse_address as $key => $address) {
                    $user_procurement_uid = get_random_id('user_procurements', 'user_procurement_uid');
                    $new_procurement = [
                        'user_type' => 'farmer',
                        'user_procurement_uid' => $user_procurement_uid,
                        'warehouse_address' => $address,
                        'warehouse_capacity' => isset($request->warehouse_capacity) && isset($request->warehouse_capacity[$key]) ? $request->warehouse_capacity[$key] : null,
                        'warehouse_type_uid' => isset($request->warehouse_type_uid) && isset($request->warehouse_type_uid[$key]) ? $request->warehouse_type_uid[$key] : null,
                        'state_uid' => isset($request->procurement_states) && isset($request->procurement_states[$key])  ? $request->procurement_states[$key] : null,
                        'district_uid' => isset($request->procurement_districts) && isset($request->procurement_districts[$key])  ? $request->procurement_districts[$key] : null,
                        'sub_district_uid' => isset($request->procurement_sub_districts) && isset($request->procurement_sub_districts[$key])  ? $request->procurement_sub_districts[$key] : null,
                        'village_uid' => isset($request->procurement_villages) && isset($request->procurement_villages[$key])  ? $request->procurement_villages[$key] : null,
                    ];
                    array_push($farmer_procurements, $new_procurement);
                }
                $farmer->userProcurements()->createMany($farmer_procurements);
            }
            DB::commit();
            session()->flash('success', 'Farmer has been created successfully !!');
            return redirect()->route('farmers.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function edit($id)
    {
        $farmer = User::find($id);

        if (is_null($farmer)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('farmers.index');
        }
        $commodities = Commodity::with('varieties')->get();
         
        $countries = Country::get();
        $states = State::get();
        $districts = District::get();
        $sub_districts = SubDistrict::get();
        $villages = Village::get();
        $pincodes = Pincode::get();
        $city = City::get();
        $warehouse_types = WarehouseType::get();
        if($farmer->district_uid != NULL){
            $farmdistricts = District::where('district_uid',$farmer->district_uid)->get();
        }else{
            $farmdistricts = array();
        }
        if($farmer->sub_district_uid != NULL){
            $farmsub_districts = SubDistrict::where('sub_district_uid',$farmer->sub_district_uid)->get();
        }else{
            $farmsub_districts = array();
        }
        if($farmer->village_uid != NULL){
            $farmvillages = Village::where('village_uid',$farmer->village_uid)->get();
        }else{
            $farmvillages = array();
        }
        if($farmer->pincode_uid != NULL){
            $farmpincodes = Pincode::where('pincode_uid',$farmer->pincode_uid)->get();
        }else{
            $farmpincodes = array();
        }
        return view('admin.farmers.edit', compact('farmer', 'commodities','city',   'warehouse_types', 'countries', 'states', 'districts', 'sub_districts', 'villages', 'pincodes','farmsub_districts','farmdistricts','farmvillages','farmpincodes'));
    }

    public function update(Request $request, $id)
    {
        $farmer = User::find($id);

        if (is_null($farmer)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('farmers.index');
        }

        $request->validate([
            'name' => 'required|string',
            'date_of_birth' => 'required',
            'gender' => 'required|string|in:male,female,other',
            'email' => 'nullable|string',
            'education_uid' => 'nullable|string',
            'address' => 'required|string',
            'country_uid' => 'required|string|exists:countries,country_uid,deleted_at,NULL',
            'state_uid' => 'required|string|exists:states,state_uid,deleted_at,NULL',
            'city_uid' => 'required|string|exists:cities,city_uid,deleted_at,NULL',
            'district_uid' => 'required|string|exists:districts,district_uid,deleted_at,NULL',
            'sub_district_uid' => 'required|string|exists:sub_districts,sub_district_uid,deleted_at,NULL',
            'village_uid' => 'required|string|exists:villages,village_uid,deleted_at,NULL',
            'pincode_uid' => 'required|string|exists:pincodes,pincode_uid,deleted_at,NULL',
 
            'aadhar_number' => 'nullable|string|min:12',
            'aadhar_document' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg',
            'account_number' => 'nullable|string',
            'account_holder_name' => 'nullable|string',
            'ifsc_code' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'branch_name' => 'nullable|string',
            'bank_document' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg',
            'address_document_type' => 'nullable|string',
            'address_document_id_number' => 'nullable|string',
            'address_document' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg',

            'commodity_uid' => 'required|array|min:1',
            'variety_uid' => 'required|array|min:1',
            'acreage' => 'required|array|min:1',
            'primary_processing_method' => 'nullable|array|min:1',

            'warehouse_address' => 'nullable|array|min:1',
            'warehouse_capacity' => 'nullable|array|min:1',
            'warehouse_type_uid' => 'nullable|array|min:1',
            'procurement_states' => 'nullable|array|min:1',
            'procurement_districts' => 'nullable|array|min:1',
            'procurement_sub_districts' => 'nullable|array|min:1',
            'procurement_villages' => 'nullable|array|min:1',
        ], [
            'education_uid.required' => 'Education field is required!',
            'education_uid.exists' => "Education doesn't exists!",
            'country_uid.required' => 'Country field is required!',
            'country_uid.exists' => "Country doesn't exists!",
            'state_uid.required' => 'State is required!',
            'state_uid.exists' => "State doesn't exists!",
            'city_uid.required' => 'City is required!',
            'city_uid.exists' => "City doesn't exists!",
            'district_uid.required' => 'District is required!',
            'district_uid.exists' => "District doesn't exists!",
            'sub_district_uid.required' => 'Sub District is required!',
            'sub_district_uid.exists' => "Sub District doesn't exists!",
            'village_uid.required' => 'Village is required!',
            'village_uid.exists' => "Village doesn't exists!",
            'pincode_uid.required' => 'Pincode is required!',
            'pincode_uid.exists' => "Pincode doesn't exists!",
            'commodity_uid.required' => 'Commodity is required!',
            'commodity_uid.exists' => "Commodity doesn't exists!",
            'variety_uid.required' => 'Variety is required!',
            'variety_uid.exists' => "Variety doesn't exists!",
        ]);

        try {
            DB::beginTransaction();

            $unique_user_id = $farmer->unique_user_id;
            $farmer->name = $request->name;
            $farmer->date_of_birth = $request->date_of_birth;
            $farmer->gender = $request->gender;
            $farmer->email = $request->email ?? null;
            $farmer->education_uid = $request->education_uid ?? null;
            $farmer->address = $request->address;
            $farmer->country_uid = $request->country_uid;
            $farmer->state_uid = $request->state_uid;
            $farmer->city_uid = $request->city_uid;
            $farmer->district_uid = $request->district_uid;
            $farmer->sub_district_uid = $request->sub_district_uid;
            $farmer->village_uid = $request->village_uid;
            $farmer->pincode_uid = $request->pincode_uid;
            $farmer->aadhar_number = $request->aadhar_number ?? null;

            if (!is_null($request->aadhar_document)) {
                $keyName = $unique_user_id . '/' . env('KEY_AADHAR_DOCUMENT');
                $farmer->aadhar_document = file_upload_on_aws($request->aadhar_document, $keyName);
                $farmer->aadhar_upload_date = now();
            }

            $farmer->account_number = $request->account_number ?? null;
            $farmer->account_holder_name = $request->account_holder_name ?? null;
            $farmer->ifsc_code = $request->ifsc_code ?? null;
            $farmer->bank_name = $request->bank_name ?? null;
            $farmer->branch_name = $request->branch_name ?? null;
            $farmer->branch_name = $request->branch_name ?? null;

            if (!is_null($request->bank_document)) {
                $keyName = $unique_user_id . '/' . env('KEY_BANK_DOCUMENT');
                $farmer->bank_document = file_upload_on_aws($request->bank_document, $keyName);
                $farmer->bank_upload_date = now();
            }

            $farmer->address_document_type = $request->address_document_type ?? null;
            $farmer->address_document_id_number = $request->address_document_id_number ?? null;

            if (!is_null($request->address_document)) {
                $keyName = $unique_user_id . '/' . env('KEY_ADDRESS_DOCUMENT');
                $farmer->address_document = file_upload_on_aws($request->address_document, $keyName);
                $farmer->address_upload_date = now();
            }

            $farmer->kyc_status = 'accepted';
            $farmer->save();


            $farmer_crop_details = [];
            foreach ($request->commodity_uid as $key => $commodity) {
                $user_crop_detail_uid = get_random_id('user_crop_details', 'user_crop_detail_uid');
                $new_crop = [
                    'user_crop_detail_uid' => $user_crop_detail_uid,
                    'commodity_uid' => $commodity,
                    'variety_uid' => isset($request->variety_uid) && isset($request->variety_uid[$key]) ? $request->variety_uid[$key] : null,
                    'acreage' => isset($request->acreage) && isset($request->acreage[$key])  ? $request->acreage[$key] : null,
                    'primary_processing_method' => isset($request->primary_processing_method) && isset($request->primary_processing_method[$key]) ? $request->primary_processing_method[$key] : 0,
                ];
                array_push($farmer_crop_details, $new_crop);
            }
            $farmer->userCropDetails()->delete();
            $farmer->userCropDetails()->createMany($farmer_crop_details);

            //procurement
            if (isset($request->warehouse_address) && !in_array(null, $request->warehouse_address)) {
                $farmer_procurements = [];
                foreach ($request->warehouse_address as $key => $address) {
                    $user_procurement_uid = get_random_id('user_procurements', 'user_procurement_uid');
                    $new_procurement = [
                        'user_type' => 'farmer',
                        'user_procurement_uid' => $user_procurement_uid,
                        'warehouse_address' => $address,
                        'warehouse_capacity' => isset($request->warehouse_capacity) && isset($request->warehouse_capacity[$key]) ? $request->warehouse_capacity[$key] : null,
                        'warehouse_type_uid' => isset($request->warehouse_type_uid) && isset($request->warehouse_type_uid[$key]) ? $request->warehouse_type_uid[$key] : null,
                        'state_uid' => isset($request->procurement_states) && isset($request->procurement_states[$key])  ? $request->procurement_states[$key] : null,
                        'district_uid' => isset($request->procurement_districts) && isset($request->procurement_districts[$key])  ? $request->procurement_districts[$key] : null,
                        'sub_district_uid' => isset($request->procurement_sub_districts) && isset($request->procurement_sub_districts[$key])  ? $request->procurement_sub_districts[$key] : null,
                        'village_uid' => isset($request->procurement_villages) && isset($request->procurement_villages[$key])  ? $request->procurement_villages[$key] : null,
                    ];
                    array_push($farmer_procurements, $new_procurement);
                }
                $farmer->userProcurements()->delete();
                $farmer->userProcurements()->createMany($farmer_procurements);
            }

            DB::commit();
            session()->flash('success', 'Farmer has been updated successfully !!');
            return redirect()->route('farmers.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function destroy($id)
    {
        $farmer = User::find($id);

        if (is_null($farmer)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('farmers.index');
        }
        // Remove Image
        UploadHelper::deleteFile('assets/uploaded_images/documents/users/' . $farmer->aadhar_document);
        UploadHelper::deleteFile('assets/uploaded_images/documents/users/' . $farmer->bank_document);
        UploadHelper::deleteFile('assets/uploaded_images/documents/users/' . $farmer->address_document);

        $farmer->userCropDetails()->delete();
        $farmer->userProcurements()->delete();

        // Delete farmer
        $farmer->deleted_by = auth()->id();
        $farmer->save();
        $farmer->delete();

        session()->flash('success', 'User has been deleted permanently !!');
        return redirect()->route('farmers.index');
    }

    public function farmerKycList()
    {
        $datas = User::where('user_type', 'farmer')->where(function ($query) {
            $query->where('aadhar_number', '!=', null)
                ->orWhere('account_number', '!=', null)
                ->orWhere('address_document_id_number', '!=', null);
        })->get();

        // if (request()->ajax()) {
        //     $farmer_kycs = User::where('user_type', 'farmer')->where(function ($query) {
        //         $query->where('aadhar_number', '!=', null)
        //             ->orWhere('account_number', '!=', null)
        //             ->orWhere('address_document_id_number', '!=', null);
        //     })->get();

        //     $datatable = DataTables::of($farmer_kycs)
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
        //             return $row->name;
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

        return view('admin.kycs.farmer-kycs', compact('datas'));
    }

    public function getFarmerKycById(Request $request)
    {
        $data = [];
        $farmer = User::where('id', $request->user_id)->first();
        if ($farmer) {
            $data = [
                'id' => $farmer->id,
                'name' => $farmer->name,
                'mobile_number' => $farmer->mobile_number,
                'aadhar_number' => $farmer->aadhar_number,
                'account_number' => $farmer->account_number,
                'account_holder_name' => $farmer->account_holder_name,
                'ifsc_code' => $farmer->ifsc_code,
                'bank_name' => $farmer->bank_name,
                'branch_name' => $farmer->branch_name,
                'address_document_type' => $farmer->address_document_type,
                'address_document_id_number' => $farmer->address_document_id_number,
                'kyc_status' => $farmer->kyc_status,
                'aadhar_document' => $farmer->aadhar_document ? get_file_from_aws($farmer->aadhar_document) : '',
                'aadhar_file_name' => substr(html_entity_decode($farmer->aadhar_document), 0, 20) . '...',
                'aadhar_upload_date' => $farmer->aadhar_upload_date ? $farmer->aadhar_upload_date->format('d/m/Y h:i A') : '',
                'bank_document' => $farmer->bank_document ? get_file_from_aws($farmer->bank_document) : '',
                'bank_file_name' => substr(html_entity_decode($farmer->bank_document), 0, 20) . '...',
                'bank_upload_date' => $farmer->bank_upload_date ? $farmer->bank_upload_date->format('d/m/Y h:i A') : '',
                'address_document' => $farmer->address_document ? get_file_from_aws($farmer->address_document) : '',
                'address_file_name' => substr(html_entity_decode($farmer->address_document), 0, 20) . '...',
                'address_upload_date' => $farmer->address_upload_date ? $farmer->address_upload_date->format('d/m/Y h:i A') : '',
            ];
        }
        return response()->json(['success' => true, 'message' => 'User KYC details get!', 'data' => $data], 200);
    }
    public function updateFarmerKycStatus(Request $request)
    {
        switch ($request->action) {
            case 'delete':
                $farmer = User::where('id', $request->user_id)->first();
                if ($farmer) {
                    UploadHelper::deleteFile('assets/uploaded_images/documents/users/' . $farmer->aadhar_document);
                    UploadHelper::deleteFile('assets/uploaded_images/documents/users/' . $farmer->bank_document);
                    UploadHelper::deleteFile('assets/uploaded_images/documents/users/' . $farmer->address_document);
                    $farmer->update([
                        'kyc_status' => null,
                        'aadhar_document' => null,
                        'bank_document' => null,
                        'address_document' => null,
                    ]);
                }
                break;
            case 'reject':
                $farmer = User::where('id', $request->user_id)->first();
                if ($farmer) {
                    $farmer->update(['kyc_status' => 'rejected']);
                }
                break;
            case 'accept':
                $farmer = User::where('id', $request->user_id)->first();
                if ($farmer) {
                    $farmer->update(['kyc_status' => 'accepted']);
                }
                break;
        }
        return response()->json(['success' => true, 'message' => 'User KYC status updated!',], 200);
    }
}
