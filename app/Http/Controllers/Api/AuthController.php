<?php

namespace App\Http\Controllers\Api;

use App\Helper\UploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\FarmerCropDetailResource;
use App\Http\Resources\FarmerKycResource;
use App\Http\Resources\FarmerResource;
use App\Http\Resources\FpoCropDetailResource;
use App\Http\Resources\FpoKycResource;
use App\Http\Resources\FpoResource;
use App\Http\Resources\ProcessorCropDetailResource;
use App\Http\Resources\ProcessorKycResource;
use App\Http\Resources\ProcessorResource;
use App\Http\Resources\TraderCropDetailResource;
use App\Http\Resources\TraderKycResource;
use App\Http\Resources\TraderResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Send otp for verification
     */

    public function sendOtp(Request $request)
    {
        $request->validate([
            'mobile_number' => 'required|numeric|digits:10'
        ]);

        //generate otp
        $otp = random_int(1000, 9999);
        $user = User::where('mobile_number', $request->mobile_number)->first();

        if ($user) {
            if ($user->hasRole(['farmer', 'fpo'])) {
                $request->validate([
                    'user_type' => 'required',
                ]);
                if ($request->user_type != 'farmerfpo') {
                    return response()->json(['success' => false, 'message' => "Number already in use!"], 200);
                }
            }
            if ($user->hasRole(['trader', 'processor'])) {
                $request->validate([
                    'user_type' => 'required',
                ]);
                if ($request->user_type != 'traderprocessor') {
                    return response()->json(['success' => false, 'message' => "Number already in use!"], 200);
                }
            }
            //Just send otp and update table
            $user->update([
                'otp' => $otp
            ]);
        } else {
            //Create user and send otp
            $userid = get_random_id('users', 'unique_user_id');
            $user = User::create([
                'unique_user_id' => $userid,
                'mobile_number' => $request->mobile_number,
                'otp' => $otp,
                'registered_from' => 'App'
            ]);
        }

        $data = [
            // 'otp' => $otp,
            'mobile_number' => $request->mobile_number,
        ];

        $api_key = env('SMS_API_KEY');
        $route = env('SMS_ROUTE');
        $sender_id = env('SMS_SENDER_ID');

        // $url =  'https://www.fast2sms.com/dev/bulkV2?authorization=' . $api_key . '&route=' . $route . '&sender_id=' . $sender_id . '&message=124573&variables_values=FarmHive%7C' . $otp . '%7C&flash=0&numbers=' . $request->mobile_number;
        // $response = file_get_contents($url);

        return response()->json(['success' => true, 'message' => 'OTP sent successfully!', 'data' => $data], 200);
    }

    /**
     * Verify otp
     */

    public function verifyOtp(Request $request)
    {
      $data =  $request->validate([
            'mobile_number' => 'required|numeric|digits:10',
            'otp' => 'required|numeric|digits:4',
            'fcm_token' => 'required|string'
        ]);

        //check otp
        $otp_exist = User::where(['mobile_number' => $request->mobile_number, 'otp' => $request->otp])->first();
        
        if (!$otp_exist) {
            return response()->json(['success' => false, 'message' => "Invalid OTP entered"], 200);
        }

        //if exists and user already register then return registered user details
      
        if ($otp_exist->hasRole(['farmer', 'fpo', 'trader', 'processor'])) {

            $otp_exist->update([
                'otp' => null,
                'otp_verified_at' => now(),
                'fcm_token' => $data['fcm_token'],
            ]);
            $response_data = [
                'user_type' => $otp_exist->user_type,
                'token' => $otp_exist->createToken('farmhive')->plainTextToken,
                'kyc_status' => $otp_exist->kyc_status,
                'fcm_token' => $data['fcm_token'],
                'razorpay_key' => env('RAZORPAY_KEY', null),
            ];

            return response()->json(['success' => true, 'message' => "OTP Verified", 'data' => $response_data], 200);
        }

        //if exists and user not registered
        $otp_exist->update([
            'otp' => null,
            'otp_verified_at' => now(),
            'fcm_token' => $data['fcm_token'],
        ]);
        $response_data = [
            'user_type' => $otp_exist->user_type,
            'token' => $otp_exist->createToken('farmhive')->plainTextToken,
            'kyc_status' => $otp_exist->kyc_status,
            'fcm_token' => $data['fcm_token'],
            'razorpay_key' => env('RAZORPAY_KEY', null),
        ];
        return response()->json(['success' => true, 'message' => 'OTP Verified', 'data' => $response_data], 200);
    }

    public function userRegistration(Request $request)
    {
        
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'user_type' => 'required|string|in:farmer,fpo,trader,processor',
                'name' => 'nullable|string|required_if:user_type,farmer,trader,processor',
                'date_of_birth' => 'nullable|date|required_if:user_type,farmer',
                'gender' => 'nullable|string|required_if:user_type,farmer',
                'email' => 'nullable|string|unique:users,email,NULL,id,deleted_at,NULL',
                'education_uid' => 'nullable|string|exists:educations,education_uid,deleted_at,NULL',
                'company_name' => 'nullable|string|required_if:user_type,fpo,trader,processor',
                'contact_person' => 'nullable|string|required_if:user_type,fpo',
                'number_of_farmers_connected' => 'nullable|integer|min:1|required_if:user_type,fpo,processor',
                'address' => 'required|string',
                'country_uid' => 'required|string|exists:countries,country_uid,deleted_at,NULL',
                'state_uid' => 'required|string|exists:states,state_uid,deleted_at,NULL',
                'district_uid' => 'required|string|exists:districts,district_uid,deleted_at,NULL',
                'city_uid' => 'required|string|exists:cities,city_uid,deleted_at,NULL',
                'sub_district_uid' => 'required|string|exists:sub_districts,sub_district_uid,deleted_at,NULL',
                'village_uid' => 'required|string|exists:villages,village_uid,deleted_at,NULL',
                'pincode_uid' => 'required|string|exists:pincodes,pincode_uid,deleted_at,NULL',
                'aadhar_number' => 'nullable|string',
                'aadhar_document' => 'nullable',
                'gst_number' => 'nullable|string',
                'gst_document' => 'nullable',
                'account_number' => 'nullable|string',
                'account_holder_name' => 'nullable|string',
                'ifsc_code' => 'nullable|string',
                'bank_name' => 'nullable|string',
                'branch_name' => 'nullable|string',
                'bank_document' => 'nullable',
                'address_document_type' => 'nullable|string',
                'address_document_id_number' => 'nullable|string',
                'address_document' => 'nullable',
                'profile_image' => 'nullable',
              
                'ho_location'=>'nullable|string',
                'job_works' =>'nullable|string|in:work,own',
                'mandi_registration_details' =>'nullable|string',
                'branch_locations' => 'nullable|string',
                'branch_locations.*' => 'nullable|string|exists:districts,district_uid,deleted_at,NULL',
    
                'user_crop_details' => 'required|array|min:1',
                'user_crop_details.*.id' => 'nullable|integer',
                'user_crop_details.*.commodity_uid' => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
                'user_crop_details.*.variety_uid' => 'required|string|exists:varieties,variety_uid,deleted_at,NULL',
                'user_crop_details.*.acreage' => 'nullable|numeric|required_if:user_type,farmer,fpo',
                'user_crop_details.*.primary_processing_method' => 'nullable|required_if:user_type,farmer,fpo',
                'user_crop_details.*.sowling_date' => 'nullable|date',
                'user_crop_details.*.farm_location' => 'nullable|string',
                'user_crop_details.*.form_factor' => 'nullable|string|exists:farm_factors,farm_factor_uid',
                'user_crop_details.*.tonnage_daily' => 'nullable|numeric',
                'user_crop_details.*.tonnage_monthly' => 'nullable|numeric',
                'user_crop_details.*.tonnage_yearly' => 'nullable|numeric',
                'user_crop_details.*.state_uid' => 'nullable|string|exists:states,state_uid,deleted_at,NULL',
                'user_crop_details.*.district_uid' => 'nullable|string|exists:districts,district_uid,deleted_at,NULL',
                'user_crop_details.*.city_uid' => 'nullable|string|exists:cities,city_uid,deleted_at,NULL',
                'user_crop_details.*.sub_district_uid' => 'nullable|string|exists:sub_districts,sub_district_uid,deleted_at,NULL',
                'user_crop_details.*.village_uid' => 'nullable|string|exists:villages,village_uid,deleted_at,NULL',
              //  'user_crop_details.*.ho_location' => 'nullable|string',
              //  'user_crop_details.*.branch_locations' => 'nullable|array|min:1',
              //  'user_crop_details.*.branch_locations.*' => 'nullable|string|exists:districts,district_uid,deleted_at,NULL',
                'user_crop_details.*.process_method_uid' => 'nullable|string',
                'user_crop_details.*.process_method_uid.*' => 'nullable|string|exists:process_methods,process_method_uid,deleted_at,NULL',
              //  'user_crop_details.*.mandi_registration_details' => 'nullable|string',
                'user_crop_details.*.process_capability_uid' => 'nullable|string',
                'user_crop_details.*.process_capability_uid.*' => 'nullable|string|exists:process_capabilities,process_capability_uid,deleted_at,NULL',
    
                'user_crop_details.*.daily_plant_capabality' => 'nullable|numeric',
                'user_crop_details.*.weekly_plant_capabality' => 'nullable|numeric',
                'user_crop_details.*.monthly_plant_capabality' => 'nullable|numeric',
                'user_crop_details.*.number_of_farmers_connected' => 'nullable|integer|min:1',
              //  'user_crop_details.*.job_works' => 'nullable|string', 
         ]);

        if ($validator->fails()){
            $failedRules = $validator->failed();
            if(isset($failedRules['email'])) {
                return response()->json(['success' => false, 'message' => 'Email id already exists!'], 200);
            }else{
                return response()->json(['success' => false, 'message' => 'The data you provided is invalid'], 200);
          }
        }
        
        $user = Auth::user();
        if ($user->hasRole(['farmer', 'fpo', 'trader', 'processor'])) {
            return response()->json(['success' => false, 'message' => 'User already exists!'], 200);
        }
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not exists!'], 200);
        }

        try {
            DB::beginTransaction();
            if (isset($data['aadhar_document'])) {
                // $data['aadhar_filename'] = UploadHelper::api_upload('image', $data['aadhar_document'], $data['aadhar_number'] . '-' . time(), 'assets/uploaded_images/documents/users');
                $keyName = $user->unique_user_id . '/' . env('KEY_AADHAR_DOCUMENT');
                $data['aadhar_filename'] = file_upload_on_aws_for_api($data['aadhar_document'], $keyName);
            }

            if (isset($data['gst_document'])) {
                // $data['gst_filename'] = UploadHelper::api_upload('image', $data['gst_document'], $data['gst_number'] . '-' . time(), 'assets/uploaded_images/documents/users');
                $keyName = $user->unique_user_id . '/' . env('KEY_GST_DOCUMENT');
                $data['gst_filename'] = file_upload_on_aws_for_api($data['gst_document'], $keyName);
            }

            if (isset($data['bank_document'])) {    
                // $data['bank_filename'] = UploadHelper::api_upload('image', $data['bank_document'], $data['account_number'] . '-' . time(), 'assets/uploaded_images/documents/users');
                $keyName = $user->unique_user_id . '/' . env('KEY_BANK_DOCUMENT');
                $data['bank_filename'] = file_upload_on_aws_for_api($data['bank_document'], $keyName);
            }

            if (isset($data['address_document'])) {
                // $data['address_filename'] = UploadHelper::api_upload('image', $data['address_document'], $data['address_document_id_number'] . '-' . time(), 'assets/uploaded_images/documents/users');
                $keyName = $user->unique_user_id . '/' . env('KEY_ADDRESS_DOCUMENT');
                $data['address_filename'] = file_upload_on_aws_for_api($data['address_document'], $keyName);
            }

            if (isset($data['profile_image'])) {
                $keyName = $user->unique_user_id . '/' . env('KEY_PROFILE_IMAGE');
                $data['profile_image'] = file_upload_on_aws_for_api($data['profile_image'], $keyName);
            }
         //   print_r($data); die;
            // $unique_user_id = get_random_id('users', 'unique_user_id');
            $user->update([
                // 'unique_user_id' => $unique_user_id,
                'name' => $data['name'] ?? null,
                'date_of_birth' => $data['date_of_birth'] ?? null,
                'gender' => $data['gender'] ?? null,
                'email' => $data['email'] ?? null,
                'education_uid' => $data['education_uid'] ?? null,
                'company_name' => $data['company_name'] ?? null,
                'contact_person' => $data['contact_person'] ?? null,
                'number_of_farmers_connected' => $data['number_of_farmers_connected'] ?? null,
                'address' => $data['address'] ?? null,
                'country_uid' => $data['country_uid'] ?? null,
                'city_uid' => $data['city_uid'] ?? null,
                'state_uid' => $data['state_uid'] ?? null,
                'district_uid' => $data['district_uid'] ?? null,
                'sub_district_uid' => $data['sub_district_uid'] ?? null,
                'village_uid' => $data['village_uid'] ?? null,
                'pincode_uid' => $data['pincode_uid'] ?? null,
                'aadhar_number' => $data['aadhar_number'] ?? null,
                'ho_location' => $data['ho_location'] ?? null,
                'job_works' => $data['job_works'] ?? null,
                'mandi_registration_details' => $data['mandi_registration_details'] ?? null,
                'branch_locations' => $data['branch_locations'] ?? null,
                // 'process_method_uid' => $data['process_method_uid'] ?? null,
                // 'process_capability_uid' => $data['process_capability_uid'] ?? null,
                'aadhar_document' => isset($data['aadhar_filename']) ? $data['aadhar_filename'] : null,
                'aadhar_upload_date' => isset($data['aadhar_filename']) ? now() : null,
                'gst_number' => $data['gst_number'] ?? null,
                'gst_document' => isset($data['gst_filename']) ? $data['gst_filename'] : null,
                'gst_upload_date' => isset($data['gst_filename']) ? now() : null,
                'account_number' => $data['account_number'] ?? null,
                'account_holder_name' => $data['account_holder_name'] ?? null,
                'ifsc_code' => $data['ifsc_code'] ?? null,
                'bank_name' => $data['bank_name'] ?? null,
                'branch_name' => $data['branch_name'] ?? null,
                'bank_document' => isset($data['bank_filename']) ? $data['bank_filename'] : null,
                'bank_upload_date' => isset($data['bank_filename']) ? now() : null,
                'address_document_type' => $data['address_document_type'] ?? null,
                'address_document_id_number' => $data['address_document_id_number'] ?? null,
                'address_document' => isset($data['address_filename']) ? $data['address_filename'] : null,
                'address_upload_date' => isset($data['address_filename']) ? now() : null,
                'profile_image' => isset($data['profile_image']) ? $data['profile_image'] : null,
                'user_type' => $data['user_type'] ?? null,
                'kyc_status' => 'pending',
                'registered_at' => now(),
            ]);

            switch ($data['user_type']) {
                case 'farmer':
                    $user->attachRole('farmer');
                    break;
                case 'fpo':
                    $user->attachRole('fpo');
                    break;
                case 'trader':
                    $user->attachRole('trader');
                    break;
                case 'processor':
                    $user->attachRole('processor');
                    break;
            }

            foreach ($data['user_crop_details'] as $crop_detail) {
                $crop_detail['user_crop_detail_uid'] = get_random_id('user_crop_details', 'user_crop_detail_uid');
                // if (isset($crop_detail['branch_locations'])) {
                //     $crop_detail['branch_locations'] = serialize($crop_detail['branch_locations']);
                // }
                if (isset($crop_detail['process_method_uid'])) {
                    $crop_detail['process_method_uid'] = $crop_detail['process_method_uid'];
                }
                if (isset($crop_detail['process_capability_uid'])) {
                    $crop_detail['process_capability_uid'] = $crop_detail['process_capability_uid'];
                }
                $user->userCropDetails()->create($crop_detail);
            }
            DB::commit();
            $additional = [
                'success' => true,
                'message' => 'User created successfully',
            ];
            switch ($data['user_type']) {
                case 'farmer':
                    return (new FarmerResource($user->load('education', 'country', 'state','city', 'district', 'subDistrict', 'village', 'pincode', 'userCropDetails')))->additional($additional);
                    break;
                case 'fpo':
                    return (new FpoResource($user->load('country', 'state','city', 'district', 'subDistrict', 'village', 'pincode', 'userCropDetails')))->additional($additional);
                    break;
                case 'trader':
                    return (new TraderResource($user->load('country', 'state','city', 'district', 'subDistrict', 'village', 'pincode', 'userCropDetails')))->additional($additional);
                    break; 
                case 'processor':
                    return (new ProcessorResource($user->load('country', 'state','city', 'district', 'subDistrict', 'village', 'pincode', 'userCropDetails')))->additional($additional);
                    break;
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function getProfileDetails()
    {
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        switch ($user->user_type) {
            case 'farmer':
                return (new FarmerResource($user->load('education', 'country', 'state','city' ,'district', 'subDistrict', 'village', 'pincode')))->additional($additional);
                break;

            case 'fpo':
                return (new FpoResource($user->load('country', 'state','city', 'district', 'subDistrict', 'village', 'pincode')))->additional($additional);
                break; 

            case 'trader':
                return (new TraderResource($user->load('country', 'state', 'city','district', 'subDistrict', 'village', 'pincode','userCropDetails')))->additional($additional);
                break;

            case 'processor':
                return (new ProcessorResource($user->load('country', 'state','city', 'district', 'subDistrict', 'village', 'pincode')))->additional($additional);
                break;
        }
    }

    public function getCropDetails()
    {
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];

        switch ($user->user_type) {
            case 'farmer':
                return FarmerCropDetailResource::collection($user->userCropDetails->load('commodity', 'variety','farm_factor','process_method','process_capability'))->additional($additional);
                break;

            case 'fpo':
                return FpoCropDetailResource::collection($user->userCropDetails->load('commodity', 'variety','farm_factor','process_method','process_capability'))->additional($additional);
                break;
 
            case 'trader': 
                return TraderCropDetailResource::collection($user->userCropDetails->load('user','commodity', 'variety', 'state', 'district', 'subDistrict', 'village','farm_factor','process_method','process_capability'))->additional($additional);
                break;

            case 'processor':
                return ProcessorCropDetailResource::collection($user->userCropDetails->load('commodity', 'variety', 'state', 'district', 'subDistrict', 'village','farm_factor','process_method','process_capability'))->additional($additional);
                break;
        }
    }

    public function getKycDetails()
    {
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        switch ($user->user_type) {
            case 'farmer':
                return (new FarmerKycResource($user->load('education', 'country', 'state','city' ,'district', 'subDistrict', 'village', 'pincode')))->additional($additional);
                break;

            case 'fpo':
                return (new FpoKycResource($user->load('education', 'country', 'state','city' ,'district', 'subDistrict', 'village', 'pincode')))->additional($additional);
                break;

            case 'trader':
                return (new TraderKycResource($user->load('education', 'country', 'state','city' ,'district', 'subDistrict', 'village', 'pincode')))->additional($additional);
                break;

            case 'processor':
                return (new ProcessorKycResource($user->load('education', 'country', 'state','city' ,'district', 'subDistrict', 'village', 'pincode')))->additional($additional);
                break;
        }
    }

    public function logout()
    {
        Auth::guard('user')->user()->currentAccessToken()->delete();
        return response()->json(['success' => true, 'message' => 'Logged out successfully!'], 200);
    }
}
