<?php

namespace App\Http\Controllers\Api;

use App\Helper\UploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommodityResource;
use App\Http\Resources\EducationResource;
use App\Http\Resources\EquipmentResource;
use App\Http\Resources\FarmerCropDetailResource;
use App\Http\Resources\FarmerKycResource;
use App\Http\Resources\FarmerResource;
use App\Http\Resources\FarmFactorResource;
use App\Http\Resources\FpoKycResource;
use App\Http\Resources\FpoResource;
use App\Http\Resources\MarketingResource;
use App\Http\Resources\NewsResource;
use App\Http\Resources\PopResource;
use App\Http\Resources\ProcessorCropDetailResource;
use App\Http\Resources\ProcessorKycResource;
use App\Http\Resources\ProcessorResource;
use App\Http\Resources\ProcessMethodResource;
use App\Http\Resources\TraderCropDetailResource;
use App\Http\Resources\TradeResource;
use App\Http\Resources\TraderKycResource;
use App\Http\Resources\TraderResource;
use App\Http\Resources\VarietyResource;
use App\Http\Resources\SectionResource;
use App\Http\Resources\BidResource;
use App\Http\Resources\ProcessCapabilityResource;
use App\Http\Resources\NotificationResource;
use App\Models\Commodity;
use App\Models\Education;
use App\Models\Equipment;
use App\Models\FarmFactor;
use App\Models\Marketing;
use App\Models\News;
use App\Models\City;
use App\Models\Pop;
use App\Models\Trade;
use App\Models\Notification;
use App\Models\UserCropDetail;
use App\Models\ProcessCapability;
use App\Models\Section;
use App\Models\Variety;
use App\Models\MarketPrice;
use App\Models\ProcessMethod;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helpers;

class CommonController extends Controller
{
    /**
     * Function for get farm factors
     *
     * @return void
     */
    public function getFarmFactors()
    {

        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $farm_factors = FarmFactor::get();
        if (count($farm_factors) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return FarmFactorResource::collection($farm_factors)->additional($additional);
    }

    /**
     * Function for get educations
     *
     * @return void
     */
    public function getEducations()
    {
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $educations = Education::get();
        if (count($educations) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return EducationResource::collection($educations)->additional($additional);
    }

    /**
     * Function for get commodities
     *
     * @return void
     */
    public function getCommodities()
    {
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $commodities = Commodity::get();
        if (count($commodities) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return CommodityResource::collection($commodities->load('varieties'))->additional($additional);
    }

    /**
     * Function for get varieties
     *
     * @return void
     */
    public function getVarieties($commodity_uid = null)
    {
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        if (isset($commodity_uid)) {
            $varieties = Variety::where('commodity_uid', $commodity_uid)->get();
            if (count($varieties) <= 0) {
                return response()->json(['success' => false, 'message' => "Data not available"], 200);
            }
            return VarietyResource::collection($varieties)->additional($additional);
        }
        $varieties = Variety::get();
        if (count($varieties) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return VarietyResource::collection($varieties)->additional($additional);
    }

    /**
     * Function for get equipments
     *
     * @return void
     */
    public function getEquipments()
    {
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $equipments = Equipment::get();
        if (count($equipments) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return EquipmentResource::collection($equipments)->additional($additional);
    }

    /**
     * Function for get news
     *
     * @return void
     */
    public function getNews()
    {

        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }

        $commodity_uids = $user->userCropDetails()->pluck('commodity_uid')->toArray();
        
        $news = News::with('commodity')->whereIn('commodity_uid', $commodity_uids)->where('deleted_at',NULL)->groupby('commodity_uid')->Orderby('updated_at','DESC')->get();

       $newsid = $news->pluck('news_uid')->toArray();
       if(count($commodity_uids)>5){
        $remaining_news = 10 - count($news);
       }else{
        $remaining_news = 5 - count($news);
       }
       
        
        if($remaining_news != 0){
            $allnews = News::whereNotIn('news_uid',$newsid)->groupby('commodity_uid')->where('deleted_at',NULL)->limit($remaining_news)->Orderby('updated_at','DESC')->get();
            $merged = $news->merge($allnews);
            $result = $merged->all();
        }else{
            $result = $news;
        }

        
        if (count($result) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return NewsResource::collection($result)->additional($additional);
    }
    public function getPopCommodity(Request $request){
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }

        $commodity_uids = $user->userCropDetails()->pluck('commodity_uid')->toArray();

        $getpop = POP::with('commodity')->whereIn('commodity_uid', $commodity_uids)->where('deleted_at',NULL)->limit(5)->Orderby('updated_at','DESC')->get();
        $commodity_uid = array_unique($getpop->pluck('commodity_uid')->toArray());

        $remaining_pops = 5 - count($commodity_uid);
        if($remaining_pops != 0){
            $allpops = POP::whereNotIn('commodity_uid',$commodity_uid)->limit($remaining_pops)->where('deleted_at',NULL)->Orderby('updated_at','DESC')->get();
            $rem_commodity_uid = array_unique($allpops->pluck('commodity_uid')->toArray());

            $merged = array_merge($commodity_uid,$rem_commodity_uid);
            $final_array = array();
            $i=0;
            foreach($merged as $val){
                $final_array[$i] = Commodity::where('commodity_uid',$val)->first();
                $i++;
            }

        }else{
           $commodities = Commodity::whereIn('commodity_uid',$commodity_uid)->get();
        }

        // $getpop = POP::where('deleted_at',NULL)->Orderby('updated_at','DESC')->get();
        // $commodity_uid = array_unique($getpop->pluck('commodity_uid')->toArray());
        // $commodities = Commodity::whereIn('commodity_uid',$commodity_uid)->get();
        return CommodityResource::collection($final_array)->additional($additional);
    }

    /**
     * Function for get pops
     *
     * @return void
     */
    public function getPops(Request $request)
    {
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $countpop =0;
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $query = Pop::where('deleted_at',NULL);
        if(isset($_GET['commodity_uid'])){
            $commodity_uid=$_GET['commodity_uid'];
            if($commodity_uid!=""){
            $query = $query->where('commodity_uid', $commodity_uid);
            $countpop =1;
            }
        }else{
            return response()->json(['success' => false, 'message' => "Please select any commodity"], 200);
        }
        if(isset($_GET['section_uid'])){
            $section_uid=$_GET['section_uid'];
            if($section_uid!=""){
            $query = $query->where('section_uid', $section_uid);
            }
        }
        $pops = $query->Orderby('updated_at','DESC')->get();
        if (count($pops) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return PopResource::collection($pops)->additional($additional);
    }

    /**
     * Function for get sections
     *
     * @return void
     */
    public function getSections(Request $request)
    {
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $section_uids = Pop::where('commodity_uid', $request->commodity_uid)->groupBy('section_uid')->pluck('section_uid')->toArray();
        $sections = Section::whereIn('section_uid', $section_uids)->get();
        if (count($sections) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return SectionResource::collection($sections)->additional($additional);
    }

    /**
     * Getting bank details1
     *
     * @param [mixed] $ifsc_code
     * @return json
     */
    public function getBankDetails($ifsc_code = null)
    {
        if (!$ifsc_code) {
            return response()->json(['success' => false, 'message' => 'Data not available'], 200);
        }

        $response = Http::get('https://ifsc.razorpay.com/' . $ifsc_code);

        if ($response->successful()) {
            $data = [
                'micr' => $response['MICR'],
                'branch' => $response['BRANCH'],
                'address' => $response['ADDRESS'],
                'state' => $response['STATE'],
                'contact' => $response['CONTACT'],
                'upi' => $response['UPI'],
                'rtgs' => $response['RTGS'],
                'city' => $response['CITY'],
                'centre' => $response['CENTRE'],
                'district' => $response['DISTRICT'],
                'neft' => $response['NEFT'],
                'imps' => $response['IMPS'],
                'swift' => $response['SWIFT'],
                'bank' => $response['BANK'],
                'bankcode' => $response['BANKCODE'],
                'ifsc' => $response['IFSC'],
            ];
            return response()->json(['success' => true, 'message' => 'Data fetched successfully', 'data' => $data], 200);
        }
        if ($response->failed()) {
            return response()->json(['success' => false, 'message' => 'Data not available'], 200);
        }
    }

    /**
     * Getting marketing and promo images
     *
     * @return json
     */
    public function getMarketingImages()
    {
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $marketings = Marketing::get();
        if (count($marketings) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return MarketingResource::collection($marketings)->additional($additional);
    }

    /**
     * Function for create trade
     *
     * @return void
     */
    public function createTrade(Request $request)
    {
        $data = $request->validate([
            'commodity_uid' => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
            'variety_uid' => 'required|string|exists:varieties,variety_uid,deleted_at,NULL',
            'description' => 'nullable|string',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'valid_from' => 'nullable|date',
            'valid_to' => 'nullable|date|after:valid_from',
            'address' => 'nullable|string',
            'taluka' => 'nullable|string',
            'state_uid' => 'nullable|string|exists:states,state_uid,deleted_at,NULL',
            'city_uid' => 'nullable|string|exists:cities,city_uid,deleted_at,NULL',
            'pincode_uid' => 'nullable|string|exists:pincodes,pincode_uid,deleted_at,NULL',
            'country_uid' => 'nullable|string|exists:countries,country_uid,deleted_at,NULL',
            'file' => 'nullable'
        ], [
            'commodity_uid.required' => 'Commodity is required!',
            'commodity_uid.exists' => "Commodity doesn't exists!",
            'variety_uid.required' => 'Variety is required!',
            'variety_uid.exists' => "Variety doesn't exists!",
            'state_uid.exists' => "State doesn't exists!",
            'city_uid.exists' => "City doesn't exists!",
            'sub_district_uid.exists' => "Sub District doesn't exists!",
            'country_uid.exists' => "Country doesn't exists!",
            'pincode_uid.exists' => "Pincode doesn't exists!",
        ]);

        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }

        $data['trade_uid'] = get_random_id('trades', 'trade_uid');
        $data['unique_user_id'] = $user->unique_user_id;

        if (isset($data['file'])) {
            $keyName = $user->unique_user_id . '/' . env('KEY_TRADE_DOCUMENT');
            $data['file'] = file_upload_on_aws_for_api($data['file'], $keyName);
        }
        $trade = Trade::create($data);

        $additional = [
            'success' => true,
            'message' => 'Trade Created successfully',
        ];
        return (new TradeResource($trade->load('commodity', 'variety', 'state', 'city', 'pincode', 'country')))->additional($additional);
    }

    /**
     * Function for getting my trade
     *
     * @return void
     */
    public function getMyTrades()
    {
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $query = Trade::where('unique_user_id',$user->unique_user_id);
        if(isset($_GET['commodity_uid'])){
            $commodity_uid=$_GET['commodity_uid'];
            if($commodity_uid!=""){
               $query=  $query->where('commodity_uid', $commodity_uid);
             }
         }
         if(isset($_GET['variety_uid'])){
            $variety_uid=$_GET['variety_uid'];
            if($variety_uid!=""){
               $query=  $query->where('variety_uid', $variety_uid);
             }
         }
         if(isset($_GET['city_uid'])){
            $city_uid=$_GET['city_uid'];
            if($city_uid!=""){
               $query=  $query->where('city_uid', $city_uid);
             }
         }
         $trades = $query->orderBy('updated_at','DESC')->get();
        if (count($trades) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return TradeResource::collection($trades->load('commodity', 'variety', 'state', 'city', 'pincode', 'country'))->additional($additional);
    }
    /**
     * Function for getting individual trades
     *
     * @return void
     */
    public function fetchTradeDetails($trade_uid)
    {
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        //$trade = Trade::where(['unique_user_id' => $user->unique_user_id, 'trade_uid' => $trade_uid])->first();
        $trade = Trade::where([ 'trade_uid' => $trade_uid])->first();

	
        if (!$trade) {
            return response()->json(['success' => false, 'message' => 'Data not available'], 200);
        }

        return (new TradeResource($trade->load('commodity', 'variety', 'state', 'city', 'pincode', 'country')))->additional($additional);
    }

    /**
     * Update crop details
     *
     * @param Request $request
     * @return void
     */
    public function updateCropDetails(Request $request)
    {
        $request->validate([
            'user_crop_detail_uid' => 'required|string|exists:user_crop_details,user_crop_detail_uid,deleted_at,NULL',
        ], [
            'user_crop_detail_uid.required' => 'Crop detail uid is invalid.',
            'user_crop_detail_uid.exists' => "Crop detail uid doesn't exists",
        ]);
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $crop_detail = UserCropDetail::where(['unique_user_id' => $user->unique_user_id, 'user_crop_detail_uid' => $request->user_crop_detail_uid])->first();
        if (!$crop_detail) {
            return response()->json(['success' => false, 'message' => 'Please provide valid crop detail uid as Param!'], 200);
        }

        $additional = [
            'success' => true,
            'message' => 'Data update successfully',
        ];

        switch ($user->user_type) {
            case 'farmer':
                $data = $request->validate([
                    'commodity_uid' => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
                    'variety_uid' => 'required|string|exists:varieties,variety_uid,deleted_at,NULL',
                    'acreage' => 'required|numeric',
                    'primary_processing_method' => 'required|in:0,1',
                ], [
                    'commodity_uid.required' => 'Commodity is required!',
                    'commodity_uid.exists' => "Commodity doesn't exists!",
                    'variety_uid.required' => 'Variety is required!',
                    'variety_uid.exists' => "Variety doesn't exists!"
                ]);
                $crop_detail->update($data);
                return (new FarmerCropDetailResource($crop_detail->load('commodity', 'variety')))->additional($additional);
                break;

            case 'fpo':
                $data = $request->validate([
                    'commodity_uid' => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
                    'variety_uid' => 'required|string|exists:varieties,variety_uid,deleted_at,NULL',
                    'acreage' => 'required|numeric',
                    'sowling_date' => 'nullable|date',
                    'farm_location' => 'nullable|string',
                    'primary_processing_method' => 'required|in:0,1',
                ], [
                    'commodity_uid.required' => 'Commodity is required!',
                    'commodity_uid.exists' => "Commodity doesn't exists!",
                    'variety_uid.required' => 'Variety is required!',
                    'variety_uid.exists' => "Variety doesn't exists!"
                ]);
                $crop_detail->update($data);
                return (new FarmerCropDetailResource($crop_detail->load('commodity', 'variety')))->additional($additional);
                break;

            case 'trader':
                $data = $request->validate([
                    'commodity_uid' => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
                    'variety_uid' => 'required|string|exists:varieties,variety_uid,deleted_at,NULL',
                    'form_factor' => 'nullable|string',
                    'tonnage_daily' => 'required|numeric',
                    'tonnage_monthly' => 'nullable|numeric',
                    'tonnage_yearly' => 'nullable|numeric',
                    'state_uid' => 'nullable|string|exists:states,state_uid,deleted_at,NULL',
                    'district_uid' => 'nullable|string|exists:districts,district_uid,deleted_at,NULL',
                    'sub_district_uid' => 'nullable|string|exists:sub_districts,sub_district_uid,deleted_at,NULL',
                    'village_uid' => 'nullable|string|exists:villages,village_uid,deleted_at,NULL',
                    'ho_location' => 'nullable|string',
                    'branch_locations' => 'nullable|array|min:1',
                    'branch_locations.*' => 'nullable|string|exists:districts,district_uid,deleted_at,NULL',
                    'process_method_uid' => 'nullable|string',
                    'process_method_uid.*' => 'nullable|string|exists:process_methods,process_method_uid,deleted_at,NULL',
                    'process_capability_uid' => 'nullable|string',
                    'process_capability_uid.*' => 'nullable|string|exists:process_capabilities,process_capability_uid,deleted_at,NULL',

                    'mandi_registration_details' => 'nullable|string',
                ], [
                    'commodity_uid.required' => 'Commodity is required!',
                    'commodity_uid.exists' => "Commodity doesn't exists!",
                    'variety_uid.required' => 'Variety is required!',
                    'variety_uid.exists' => "Variety doesn't exists!",
                    'state_uid.exists' => "State doesn't exists!",
                    'district_uid.exists' => "District doesn't exists!",
                    'sub_district_uid.exists' => "Sub District doesn't exists!",
                    'village_uid.exists' => "Village doesn't exists!",
                    'pincode_uid.exists' => "Pincode doesn't exists!",
                ]);
                if (isset($data['branch_locations'])) {
                    $data['branch_locations'] = $data['branch_locations'];
                }
                if (isset($data['process_method_uid'])) {
                    $data['process_method_uid'] = $data['process_method_uid'];
                }
                $crop_detail->update($data);
                return (new TraderCropDetailResource($crop_detail->load('commodity', 'variety', 'state', 'district', 'subDistrict', 'village')))->additional($additional);
                break;

            case 'processor':
                $data = $request->validate([
                    'commodity_uid' => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
                    'variety_uid' => 'required|string|exists:varieties,variety_uid,deleted_at,NULL',
                    'number_of_farmers_connected' => 'nullable|integer|min:1',
                    'acreage' => 'nullable|numeric|required_if:user_type,farmer,fpo',
                    'process_capability_uid' => 'nullable|array|min:1',
                    'process_capability_uid.*' => 'nullable|string|exists:process_capabilities,process_capability_uid,deleted_at,NULL',
                    'daily_plant_capabality' => 'nullable|numeric',
                    'weekly_plant_capabality' => 'nullable|numeric',
                    'monthly_plant_capabality' => 'nullable|numeric',
                    'job_works' => 'nullable|string|in:work,own',
                    'state_uid' => 'nullable|string|exists:states,state_uid,deleted_at,NULL',
                    'district_uid' => 'nullable|string|exists:districts,district_uid,deleted_at,NULL',
                    'sub_district_uid' => 'nullable|string|exists:sub_districts,sub_district_uid,deleted_at,NULL',
                    'village_uid' => 'nullable|string|exists:villages,village_uid,deleted_at,NULL',
                    'process_method_uid' => 'nullable|string',
                    'process_method_uid.*' => 'nullable|string|exists:process_methods,process_method_uid,deleted_at,NULL',
                    'process_capability_uid' => 'nullable|string',
                    'process_capability_uid.*' => 'nullable|string|exists:process_capabilities,process_capability_uid,deleted_at,NULL',
         ], [
                    'commodity_uid.required' => 'Commodity is required!',
                    'commodity_uid.exists' => "Commodity doesn't exists!",
                    'variety_uid.required' => 'Variety is required!',
                    'variety_uid.exists' => "Variety doesn't exists!",
                    'state_uid.exists' => "State doesn't exists!",
                    'district_uid.exists' => "District doesn't exists!",
                    'sub_district_uid.exists' => "Sub District doesn't exists!",
                    'village_uid.exists' => "Village doesn't exists!",
                    'pincode_uid.exists' => "Pincode doesn't exists!",
                ]);
                if (isset($data['process_method_uid'])) {
                    $data['process_method_uid'] = $data['process_method_uid'];
                }
                if (isset($data['process_capability_uid'])) {
                    $data['process_capability_uid'] = $data['process_capability_uid'];
                }
                $crop_detail->update($data);
                return (new ProcessorCropDetailResource($crop_detail->load('commodity', 'variety', 'state', 'district', 'subDistrict', 'village')))->additional($additional);
                break;
        }
    }

    /**
     * Delete crop details
     *
     * @param Request $request
     * @return void
     */
    public function deleteCropDetails($user_crop_detail_uid)
    {
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $crop_detail = UserCropDetail::where(['unique_user_id' => $user->unique_user_id, 'user_crop_detail_uid' => $user_crop_detail_uid])->first();
        if (!$crop_detail) {
            return response()->json(['success' => false, 'message' => 'Please provide valid crop detail Id as Param!'], 200);
        }

        $crop_detail->deleted_by = Auth::user()->id;
        $crop_detail->save();
        $crop_detail->delete();

        return response()->json(['success' => true, 'message' => 'Crop details has been deleted successfully!'], 200);
    }
   /**
     * Add crop details
     *
     * @param Request $request
     * @return void
     */
    public function addCropDetails(Request $request)
    {
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $additional = [
            'success' => true,
            'message' => 'Crop Detail added successfully',
        ];
       // print_r($user); die;
        switch ($user->user_type) {
            case 'farmer':
                $data = $request->validate([
                    'commodity_uid' => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
                    'variety_uid' => 'required|string|exists:varieties,variety_uid,deleted_at,NULL',
                    'acreage' => 'required|numeric',
                    'primary_processing_method' => 'required|in:0,1',
                ], [
                    'commodity_uid.required' => 'Commodity is required!',
                    'commodity_uid.exists' => "Commodity doesn't exists!",
                    'variety_uid.required' => 'Variety is required!',
                    'variety_uid.exists' => "Variety doesn't exists!"
                ]);
                $data['user_crop_detail_uid'] = get_random_id('user_crop_details', 'user_crop_detail_uid');
                $data['unique_user_id'] = $user->unique_user_id;
                $crop_detail = UserCropDetail::create($data);
                return (new FarmerCropDetailResource($crop_detail->load('commodity', 'variety')))->additional($additional);
                break;

            case 'fpo':
                $data = $request->validate([
                    'commodity_uid' => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
                    'variety_uid' => 'required|string|exists:varieties,variety_uid,deleted_at,NULL',
                    'acreage' => 'required|numeric',
                    'sowling_date' => 'nullable|date',
                    'farm_location' => 'nullable|string',
                    'primary_processing_method' => 'required|in:0,1',
                ], [
                    'commodity_uid.required' => 'Commodity is required!',
                    'commodity_uid.exists' => "Commodity doesn't exists!",
                    'variety_uid.required' => 'Variety is required!',
                    'variety_uid.exists' => "Variety doesn't exists!"
                ]);
                $data['user_crop_detail_uid'] = get_random_id('user_crop_details', 'user_crop_detail_uid');
                $data['unique_user_id'] = $user->unique_user_id;
                $crop_detail = UserCropDetail::create($data);
                return (new FarmerCropDetailResource($crop_detail->load('commodity', 'variety')))->additional($additional);
                break;

            case 'trader':
                $data = $request->validate([
                    'commodity_uid' => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
                    'variety_uid' => 'required|string|exists:varieties,variety_uid,deleted_at,NULL',
                    'form_factor' => 'nullable|string',
                    'tonnage_daily' => 'required|numeric',
                    'tonnage_monthly' => 'nullable|numeric',
                    'tonnage_yearly' => 'nullable|numeric',
                    'state_uid' => 'nullable|string|exists:states,state_uid,deleted_at,NULL',
                    'district_uid' => 'nullable|string|exists:districts,district_uid,deleted_at,NULL',
                    'sub_district_uid' => 'nullable|string|exists:sub_districts,sub_district_uid,deleted_at,NULL',
                    'village_uid' => 'nullable|string|exists:villages,village_uid,deleted_at,NULL',
                    'ho_location' => 'nullable|string',
                    'branch_locations' => 'nullable|array|min:1',
                    'branch_locations.*' => 'nullable|string|exists:districts,district_uid,deleted_at,NULL',
                    'process_method_uid' => 'nullable|string',
                    'process_method_uid.*' => 'nullable|string|exists:process_methods,process_method_uid,deleted_at,NULL',
                    'process_capability_uid' => 'nullable|string',
                    'process_capability_uid.*' => 'nullable|string|exists:process_capabilities,process_capability_uid,deleted_at,NULL',

                    'mandi_registration_details' => 'nullable|string',
                ], [
                    'commodity_uid.required' => 'Commodity is required!',
                    'commodity_uid.exists' => "Commodity doesn't exists!",
                    'variety_uid.required' => 'Variety is required!',
                    'variety_uid.exists' => "Variety doesn't exists!",
                    'state_uid.exists' => "State doesn't exists!",
                    'district_uid.exists' => "District doesn't exists!",
                    'sub_district_uid.exists' => "Sub District doesn't exists!",
                    'village_uid.exists' => "Village doesn't exists!",
                    'pincode_uid.exists' => "Pincode doesn't exists!",
                ]);
                if (isset($data['branch_locations'])) {
                    $data['branch_locations'] = $data['branch_locations'];
                }
                if (isset($data['process_method_uid'])) {
                    $data['process_method_uid'] = $data['process_method_uid'];
                }
                $data['user_crop_detail_uid'] = get_random_id('user_crop_details', 'user_crop_detail_uid');
                $data['unique_user_id'] = $user->unique_user_id;
                $crop_detail = UserCropDetail::create($data);
                return (new TraderCropDetailResource($crop_detail->load('commodity', 'variety', 'state', 'district', 'subDistrict', 'village')))->additional($additional);
                break;

            case 'processor':
                $data = $request->validate([
                    'commodity_uid' => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
                    'variety_uid' => 'required|string|exists:varieties,variety_uid,deleted_at,NULL',
                    'number_of_farmers_connected' => 'nullable|integer|min:1',
                    'acreage' => 'nullable|numeric|required_if:user_type,farmer,fpo',
                    'process_capability_uid' => 'nullable|array|min:1',
                    'process_capability_uid.*' => 'nullable|string|exists:process_capabilities,process_capability_uid,deleted_at,NULL',
                    'daily_plant_capabality' => 'nullable|numeric',
                    'weekly_plant_capabality' => 'nullable|numeric',
                    'monthly_plant_capabality' => 'nullable|numeric',
                    'job_works' => 'nullable|string|in:work,own',
                    'state_uid' => 'nullable|string|exists:states,state_uid,deleted_at,NULL',
                    'district_uid' => 'nullable|string|exists:districts,district_uid,deleted_at,NULL',
                    'sub_district_uid' => 'nullable|string|exists:sub_districts,sub_district_uid,deleted_at,NULL',
                    'village_uid' => 'nullable|string|exists:villages,village_uid,deleted_at,NULL',
                    'process_method_uid' => 'nullable|string',
                    'process_method_uid.*' => 'nullable|string|exists:process_methods,process_method_uid,deleted_at,NULL',
                    'process_capability_uid' => 'nullable|string',
                    'process_capability_uid.*' => 'nullable|string|exists:process_capabilities,process_capability_uid,deleted_at,NULL',
         ], [
                    'commodity_uid.required' => 'Commodity is required!',
                    'commodity_uid.exists' => "Commodity doesn't exists!",
                    'variety_uid.required' => 'Variety is required!',
                    'variety_uid.exists' => "Variety doesn't exists!",
                    'state_uid.exists' => "State doesn't exists!",
                    'district_uid.exists' => "District doesn't exists!",
                    'sub_district_uid.exists' => "Sub District doesn't exists!",
                    'village_uid.exists' => "Village doesn't exists!",
                    'pincode_uid.exists' => "Pincode doesn't exists!",
                ]);
                if (isset($data['process_method_uid'])) {
                    $data['process_method_uid'] = $data['process_method_uid'];
                }
                if (isset($data['process_capability_uid'])) {
                    $data['process_capability_uid'] = $data['process_capability_uid'];
                }
                $data['user_crop_detail_uid'] = get_random_id('user_crop_details', 'user_crop_detail_uid');
                $data['unique_user_id'] = $user->unique_user_id;
                $crop_detail = UserCropDetail::create($data);
                return (new ProcessorCropDetailResource($crop_detail->load('commodity', 'variety', 'state', 'district', 'subDistrict', 'village')))->additional($additional);
                break;
        }
        // $data = $request->validate([
        //     'commodity_uid' => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
        //     'variety_uid' => 'required|string|exists:varieties,variety_uid,deleted_at,NULL',
        //     'acreage' => 'nullable|numeric',
        //     'primary_processing_method' => 'nullable',
        //     'process_method_uid'=>'nullable|string',
        //     'process_method_uid'=>'nullable|string|exists:process_methods,process_method_uid,deleted_at,NULL',
        //     'ho_location'=>'nullable|string',
        //     'job_works' =>'nullable|string',
        //     'sowling_date' => 'nullable|date',
        //     'farm_location' => 'nullable|string',
        //     'form_factor' => 'nullable|string|exists:farm_factors,farm_factor_uid',
        //     'tonnage_daily' => 'nullable|numeric',
        //     'tonnage_monthly' => 'nullable|numeric',
        //     'tonnage_yearly' => 'nullable|numeric',
        //     'state_uid' => 'nullable|string|exists:states,state_uid,deleted_at,NULL',
        //     'district_uid' => 'nullable|string|exists:districts,district_uid,deleted_at,NULL',
        //     'city_uid' => 'nullable|string|exists:cities,city_uid,deleted_at,NULL',
        //     'sub_district_uid' => 'nullable|string|exists:sub_districts,sub_district_uid,deleted_at,NULL',
        //     'village_uid' => 'nullable|string|exists:villages,village_uid,deleted_at,NULL',
        //     'process_capability_uid' => 'nullable|array|min:1',
        //     'process_capability_uid.*' => 'nullable|string|exists:process_capabilities,process_capability_uid,deleted_at,NULL',
        //     'daily_plant_capabality' => 'nullable|numeric',
        //     'weekly_plant_capabality' => 'nullable|numeric',
        //     'monthly_plant_capabality' => 'nullable|numeric',
        //     'number_of_farmers_connected' => 'nullable|integer|min:1',

        // ]);


    }
    /**
     * Update profile details
     *
     * @param Request $request
     * @return response
     */
    public function updateProfileDetails(Request $request)
    {
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $additional = [
            'success' => true,
            'message' => 'Data update successfully',
        ];
        switch ($user->user_type) {
            case 'farmer':
                $data = $request->validate([
                    'name' => 'required|string',
                    'date_of_birth' => 'required|date',
                    'gender' => 'required|string',
                     'email' => 'nullable|string|unique:users,email,' . $user->id,
                    'education_uid' => 'nullable|string|exists:educations,education_uid,deleted_at,NULL',
                    'address' => 'required|string',
                    // 'country_uid' => 'required|string|exists:countries,country_uid,deleted_at,NULL',
                    'state_uid' => 'required|string|exists:states,state_uid,deleted_at,NULL',
                    'city_uid' => 'required|string|exists:cities,city_uid,deleted_at,NULL',
                    'district_uid' => 'required|string|exists:districts,district_uid,deleted_at,NULL',
                    'sub_district_uid' => 'required|string|exists:sub_districts,sub_district_uid,deleted_at,NULL',
                    'village_uid' => 'required|string|exists:villages,village_uid,deleted_at,NULL',
                    'pincode_uid' => 'required|string|exists:pincodes,pincode_uid,deleted_at,NULL',
                    'profile_image' => 'nullable',
                ], [
                    'education_uid.exists' => "Education doesn't exists!",
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
                ]);

                if (isset($data['profile_image'])) {
                    $keyName = $user->unique_user_id . '/' . env('KEY_PROFILE_IMAGE');
                    $data['profile_image'] = file_upload_on_aws_for_api($data['profile_image'], $keyName);
                } else {
                    $data['profile_image'] = $user->profile_image;
                }

                $user->update($data);
                return (new FarmerResource($user->load('education', 'country', 'state','city', 'district', 'subDistrict', 'village', 'pincode')))->additional($additional);
                break;

            case 'fpo':
                $data = $request->validate([
                    'company_name' => 'required|string',
                    'contact_person' => 'required|string',
                    'email' => 'nullable|string|unique:users,email,' . $user->id,
                    'address' => 'required|string',
                    'number_of_farmers_connected' => 'required|integer|min:1',
                    // 'country_uid' => 'required|string|exists:countries,country_uid,deleted_at,NULL',
                    'state_uid' => 'required|string|exists:states,state_uid,deleted_at,NULL',
                    'city_uid' => 'required|string|exists:cities,city_uid,deleted_at,NULL',
                    'district_uid' => 'required|string|exists:districts,district_uid,deleted_at,NULL',
                    'sub_district_uid' => 'required|string|exists:sub_districts,sub_district_uid,deleted_at,NULL',
                    'village_uid' => 'required|string|exists:villages,village_uid,deleted_at,NULL',
                    'pincode_uid' => 'required|string|exists:pincodes,pincode_uid,deleted_at,NULL',
                    'profile_image' => 'nullable',
                ], [
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
                ]);
                if (isset($data['profile_image'])) {
                    $keyName = $user->unique_user_id . '/' . env('KEY_PROFILE_IMAGE');
                    $data['profile_image'] = file_upload_on_aws_for_api($data['profile_image'], $keyName);
                } else {
                    $data['profile_image'] = $user->profile_image;
                }
                $user->update($data);
                return (new FpoResource($user->load('country', 'state','city', 'district', 'subDistrict', 'village', 'pincode')))->additional($additional);
                break;

            case 'trader':
                $data = $request->validate([
                    'name' => 'required|string',
                    'company_name' => 'required|string',
                    'email' => 'nullable|string|unique:users,email,' . $user->id,
                    'address' => 'required|string',
                    // 'country_uid' => 'required|string|exists:countries,country_uid,deleted_at,NULL',
                    'state_uid' => 'required|string|exists:states,state_uid,deleted_at,NULL',
                    'city_uid' => 'required|string|exists:cities,city_uid,deleted_at,NULL',
                    'district_uid' => 'required|string|exists:districts,district_uid,deleted_at,NULL',
                    'sub_district_uid' => 'required|string|exists:sub_districts,sub_district_uid,deleted_at,NULL',
                    'village_uid' => 'required|string|exists:villages,village_uid,deleted_at,NULL',
                    'pincode_uid' => 'required|string|exists:pincodes,pincode_uid,deleted_at,NULL',
                    'profile_image' => 'nullable',
                ], [
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
                ]);
                if (isset($data['profile_image'])) {
                    $keyName = $user->unique_user_id . '/' . env('KEY_PROFILE_IMAGE');
                    $data['profile_image'] = file_upload_on_aws_for_api($data['profile_image'], $keyName);
                } else {
                    $data['profile_image'] = $user->profile_image;
                }
                $user->update($data);
                return (new TraderResource($user->load('country', 'state', 'city','district', 'subDistrict', 'village', 'pincode')))->additional($additional);
                break;

            case 'processor':
                $data = $request->validate([
                    'name' => 'required|string',
                    'company_name' => 'required|string',
                    'email' => 'nullable|string|unique:users,email,' . $user->id,
                    'number_of_farmers_connected' => 'required|integer|min:1',
                    'address' => 'required|string',
                    // 'country_uid' => 'required|string|exists:countries,country_uid,deleted_at,NULL',
                    'city_uid' => 'required|string|exists:cities,city_uid,deleted_at,NULL',
                    'state_uid' => 'required|string|exists:states,state_uid,deleted_at,NULL',
                    'district_uid' => 'required|string|exists:districts,district_uid,deleted_at,NULL',
                    'sub_district_uid' => 'required|string|exists:sub_districts,sub_district_uid,deleted_at,NULL',
                    'village_uid' => 'required|string|exists:villages,village_uid,deleted_at,NULL',
                    'pincode_uid' => 'required|string|exists:pincodes,pincode_uid,deleted_at,NULL',
                    'profile_image' => 'nullable',
                ], [
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
                ]);
                if (isset($data['profile_image'])) {
                    $keyName = $user->unique_user_id . '/' . env('KEY_PROFILE_IMAGE');
                    $data['profile_image'] = file_upload_on_aws_for_api($data['profile_image'], $keyName);
                } else {
                    $data['profile_image'] = $user->profile_image;
                }
                $user->update($data);
                return (new ProcessorResource($user->load('country', 'state','city', 'district', 'subDistrict', 'village', 'pincode')))->additional($additional);
                break;
        }
    }

    /**
     * Update kyc details
     *
     * @param Request $request
     * @return response
     */
    public function addKycDetails(Request $request)
    {
        $data = $request->validate([
            'aadhar_number' => 'nullable|numeric',
            'aadhar_document' => 'nullable',
            'gst_number' => 'nullable|string',
            'gst_document' => 'nullable',
            'account_number' => 'nullable|string',
            'account_holder_name' => 'nullable|string',
            'ifsc_code' => 'nullable|string',
            'bank_document' => 'nullable',
            'address_document_type' => 'nullable|string',
            'address_document_id_number' => 'nullable|string',
            'address_document' => 'nullable',
        ]);

        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }

        //get bank branch and bank name by ifsc code
        $bank_name = $user->bank_name;
        $branch_name = $user->branch_name;
        if (isset($data['ifsc_code'])) {
            $response = Http::get('https://ifsc.razorpay.com/' . $data['ifsc_code']);
            if ($response->successful()) {
                $bank_name = $response['BANK'];
                $branch_name = $response['BRANCH'];
            }
            if ($response->failed()) {
                return response()->json(['success' => false, 'message' => 'Invalid IFSC Code'], 200);
            }
        }

        if (isset($data['aadhar_document'])) {
            $keyName = $user->unique_user_id . '/' . env('KEY_AADHAR_DOCUMENT');
            $data['aadhar_filename'] = file_upload_on_aws_for_api($data['aadhar_document'], $keyName);
        }

        if (isset($data['gst_document'])) {
            $keyName = $user->unique_user_id . '/' . env('KEY_GST_DOCUMENT');
            $data['gst_filename'] = file_upload_on_aws_for_api($data['gst_document'], $keyName);
        }

        if (isset($data['bank_document'])) {
            $keyName = $user->unique_user_id . '/' . env('KEY_BANK_DOCUMENT');
            $data['bank_filename'] = file_upload_on_aws_for_api($data['bank_document'], $keyName);
        }

        if (isset($data['address_document'])) {
            $keyName = $user->unique_user_id . '/' . env('KEY_ADDRESS_DOCUMENT');
            $data['address_filename'] = file_upload_on_aws_for_api($data['address_document'], $keyName);
        }
        $user->update([
            'aadhar_number' => $request->aadhar_number ?? null,
            'aadhar_document' => isset($data['aadhar_filename']) ? $data['aadhar_filename'] : $user->aadhar_document,
            'aadhar_upload_date' => isset($data['aadhar_filename']) ? now() : $user->aadhar_upload_date,
            'gst_number' => $request->gst_number ?? null,
            'gst_document' => isset($data['gst_filename']) ? $data['gst_filename'] : $user->gst_document,
            'gst_upload_date' => isset($data['gst_filename']) ? now() : $user->gst_upload_date,
            'account_number' => $request->account_number ?? null,
            'account_holder_name' => $request->account_holder_name ?? null,
            'ifsc_code' => $request->ifsc_code ?? null,
            'bank_name' => $bank_name,
            'branch_name' => $branch_name,
            'bank_document' => isset($data['bank_filename']) ? $data['bank_filename'] : $user->bank_document,
            'bank_upload_date' => isset($data['bank_filename']) ? now() : $user->bank_upload_date,
            'address_document_type' => $request->address_document_type ?? null,
            'address_document_id_number' => $request->address_document_id_number ?? null,
            'address_document' => isset($data['address_filename']) ? $data['address_filename'] : $user->address_document,
            'address_upload_date' => isset($data['address_filename']) ? now() : $user->address_upload_date,
            'kyc_status' => isset($data['aadhar_document']) || isset($data['gst_document']) || isset($data['bank_document']) || isset($data['address_document']) ? 'pending' : $user->kyc_status,
        ]);
        $additional = [
            'success' => true,
            'message' => 'Data added successfully',
        ];
        switch ($user->user_type) {
            case 'farmer':
                return (new FarmerKycResource($user))->additional($additional);
                break;

            case 'fpo':
                return (new FpoKycResource($user))->additional($additional);
                break;

            case 'trader':
                return (new TraderKycResource($user))->additional($additional);
                break;

            case 'processor':
                return (new ProcessorKycResource($user))->additional($additional);
                break;
        }
    }

    /**
     * Update kyc details
     *
     * @param Request $request
     * @return response
     */
    public function updateKycDetails(Request $request)
    {
        $data = $request->validate([
            'aadhar_number' => 'nullable|numeric',
            'aadhar_document' => 'nullable',
            'gst_number' => 'nullable|string',
            'gst_document' => 'nullable',
            'account_number' => 'nullable|string',
            'account_holder_name' => 'nullable|string',
            'ifsc_code' => 'nullable|string',
            'bank_document' => 'nullable',
            'address_document_type' => 'nullable|string',
            'address_document_id_number' => 'nullable|string',
            'address_document' => 'nullable',
        ]);

        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }

        //get bank branch and bank name by ifsc code
        $bank_name = $user->bank_name;
        $branch_name = $user->branch_name;
        if (isset($data['ifsc_code'])) {
            $response = Http::get('https://ifsc.razorpay.com/' . $data['ifsc_code']);
            if ($response->successful()) {
                $bank_name = $response['BANK'];
                $branch_name = $response['BRANCH'];
            }
            if ($response->failed()) {
                return response()->json(['success' => false, 'message' => 'Invalid IFSC Code'], 200);
            }
        }

        if (isset($data['aadhar_document'])) {
            $keyName = $user->unique_user_id . '/' . env('KEY_AADHAR_DOCUMENT');
            $data['aadhar_filename'] = file_upload_on_aws_for_api($data['aadhar_document'], $keyName);
        }

        if (isset($data['gst_document'])) {
            $keyName = $user->unique_user_id . '/' . env('KEY_GST_DOCUMENT');
            $data['gst_filename'] = file_upload_on_aws_for_api($data['gst_document'], $keyName);
        }

        if (isset($data['bank_document'])) {
            $keyName = $user->unique_user_id . '/' . env('KEY_BANK_DOCUMENT');
            $data['bank_filename'] = file_upload_on_aws_for_api($data['bank_document'], $keyName);
        }

        if (isset($data['address_document'])) {
            $keyName = $user->unique_user_id . '/' . env('KEY_ADDRESS_DOCUMENT');
            $data['address_filename'] = file_upload_on_aws_for_api($data['address_document'], $keyName);
        }
        $user->update([
            'aadhar_number' => $request->aadhar_number ?? null,
            'aadhar_document' => isset($data['aadhar_filename']) ? $data['aadhar_filename'] : $user->aadhar_document,
            'aadhar_upload_date' => isset($data['aadhar_filename']) ? now() : $user->aadhar_upload_date,
            'gst_number' => $request->gst_number ?? null,
            'gst_document' => isset($data['gst_filename']) ? $data['gst_filename'] : $user->gst_document,
            'gst_upload_date' => isset($data['gst_filename']) ? now() : $user->gst_upload_date,
            'account_number' => $request->account_number ?? null,
            'account_holder_name' => $request->account_holder_name ?? null,
            'ifsc_code' => $request->ifsc_code ?? null,
            'bank_name' => $bank_name,
            'branch_name' => $branch_name,
            'bank_document' => isset($data['bank_filename']) ? $data['bank_filename'] : $user->bank_document,
            'bank_upload_date' => isset($data['bank_filename']) ? now() : $user->bank_upload_date,
            'address_document_type' => $request->address_document_type ?? null,
            'address_document_id_number' => $request->address_document_id_number ?? null,
            'address_document' => isset($data['address_filename']) ? $data['address_filename'] : $user->address_document,
            'address_upload_date' => isset($data['address_filename']) ? now() : $user->address_upload_date,
            'kyc_status' => isset($data['aadhar_document']) || isset($data['gst_document']) || isset($data['bank_document']) || isset($data['address_document']) ? 'pending' : $user->kyc_status,
        ]);
        $additional = [
            'success' => true,
            'message' => 'Data updated successfully',
        ];
        switch ($user->user_type) {
            case 'farmer':
                return (new FarmerKycResource($user))->additional($additional);
                break;

            case 'fpo':
                return (new FpoKycResource($user))->additional($additional);
                break;

            case 'trader':
                return (new TraderKycResource($user))->additional($additional);
                break;

            case 'processor':
                return (new ProcessorKycResource($user))->additional($additional);
                break;
        }
    }

    /**
     * Function for get user commodities
     *
     * @return void
     */
    public function getUserCommodities()
    {
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $commodity_uids = UserCropDetail::where('unique_user_id', $user->unique_user_id)->pluck('commodity_uid');
        $commodities = Commodity::whereIn('commodity_uid', $commodity_uids)->get();
        if (count($commodities) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return CommodityResource::collection($commodities->load('varieties'))->additional($additional);
    }

    public function getWeather(Request $request)
    {
        $appid = env('WEATHER_API_KEY');
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        if ($user->city_uid == NULL) {
            return response()->json(['success' => false, 'message' => "User city is not available"], 200);
        }
        $citydata = City::where('city_uid',$user->city_uid)->first();
        $lat = $citydata->latitude;
        $lon = $citydata->longitude;
        //var_dump($citydata);die;exit;
        try {
            $client = new \GuzzleHttp\Client();
            $res = $client->request('GET', 'api.openweathermap.org/data/2.5/forecast?lat=' . $lat . '&lon=' . $lon . '&appid=' . $appid . '&units=metric');
            $response = $res->getBody();
            $response = json_decode($response);
            if ($response->cod == "200") {
                $res = $response->list;
                $currentDateTime = date('Y-m-d h:i:s');
                $new_list = [];
                foreach ($res as $r) {
                    $dateTime = $r->dt_txt;
                    $r->dt_day = date('l', $r->dt);
                    $r->city_name =$citydata->city_name;
                    if ($currentDateTime <= $dateTime) {
                        $r->weather[0]->icon = env('WEATHER_API_URL') . $r->weather[0]->icon . '.png';
                        $r->dt_txt = date('d/m/Y', strtotime($r->dt_txt));
                        $new_list[] = $r;
                        $currentDateTime = date('Y-m-d h:i:s', strtotime($currentDateTime . ' + 1 days'));
                    }
                }
                $data = [
                    'success' => true,
                    'message' => 'Data fetched successfully',
                    'data' => $new_list
                ];
            } else {
                $data = [
                    'success' => false,
                    'message' => 'Something went wrong',
                ];
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 200);
        }

        return response()->json($data, 200);
    }

    public function getMarketPrice()
    {
      
         try {

            DB::beginTransaction();
            $api_key = env('MARKET_PRICE_API_KEY');
            $client = new \GuzzleHttp\Client();
           
            $res = $client->request('GET', 'https://api.data.gov.in/resource/9ef84268-d588-465a-a308-a864a43d0070?api-key=' . $api_key . '&format=json');
            $response = $res->getBody();
	  //  var_dump($response);die;exit;
            $response = json_decode($response);
	   //var_dump($response);die;exit;
            if ($response != null) {

                $todayDate = date('d/m/Y', $response->updated);
                $exist = MarketPrice::where('arrival_date', $todayDate)->get();
                if (count($exist) > 0) {

                    $data = [
                        'success' => true,
                        'message' => 'Data fetched successfully',
                        'data' => $exist
                    ];
                } else {


                    $records = $response->records;
                    $limit = $response->total;
                    $res = $client->request('GET', 'https://api.data.gov.in/resource/9ef84268-d588-465a-a308-a864a43d0070?api-key=' . $api_key . '&format=json&limit=' . $limit);
                    $response = $res->getBody();
                        
                    $response = json_decode($response);
                    $records = $response->records;
		    // var_dump(count($records));die;exit;
                  //  $i =0;
                    foreach ($records as $r) {

                        $temp1 = MarketPrice::where('state', $r->state)->where('district', $r->district)->where('market', $r->market)->where('commodity', $r->commodity)->where('variety', $r->variety)->first();
                       //	 var_dump($temp1->toArray()).PHP_EOL;	
			 if (!$temp1) {

                            //insert
			  //  echo 'here';
                           $max_price = ((double)$r->max_price)/100;
                            $insert_data = [
                                'market_price_uid' => get_random_id('market_prices', 'market_price_uid'),
                                'state' => $r->state,
                                'district' => $r->district,
                                'market' => $r->market,
                                'commodity' => $r->commodity,
                                'variety' => $r->variety,
                                 'arrival_date' => $todayDate,
                                'current_min_price' => $r->min_price,
                                'current_max_price' => $max_price,
                                'current_modal_price' => $r->modal_price,
                                'previous_min_price' => $r->min_price,
                               'previous_max_price' => $max_price,
                                'previous_modal_price' => $r->modal_price
                            ];
                           
                        $insert = MarketPrice::create($insert_data);
			// echo "CREATE - " ;var_dump($insert)>PHP_EOL;
                        } else {
                            //update
                            $temp1->previous_min_price = $temp1->current_min_price;
                             $temp1->previous_max_price = ((double) $temp1->current_max_price);
                            $temp1->previous_modal_price = $temp1->current_modal_price;
                            $temp1->current_min_price = $r->min_price;
                            $temp1->current_max_price = ((double)$r->max_price)/100;
                            $temp1->current_modal_price = $r->modal_price;
                             $temp1->arrival_date = $todayDate;
                            $update = $temp1->update();
			  //  echo "UPDATE - " ;var_dump($update)>PHP_EOL;
                        }
                        //if($i>0){
                          //  break;
                     //}
                       // $i++;
                    }
                     $exist = MarketPrice::where('arrival_date', $todayDate)->get();
                    // $exist = MarketPrice::find(['arrival_date'=>$todayDate])->all()->get();
                    // $exist = DB::raw('SELECT * FROM `market_prices` WHERE `arrival_date`= "{$todayDate}"');
                    $data = [
                        'success' => true,
                        'message' => 'Data fetched successfully',
                        'data' => $exist
                    ];
                }
            } else {

                $data = [
                    'success' => false,
                    'message' => 'Something went wrong',
                ];
            }
         } catch (\Exception $e) {
             DB::rollBack();
             return response()->json(['success' => false, 'message' => $e->getMessage()], 200);
         }

         DB::commit();
        return response()->json($data, 200);
    }
    public function getPrice(Request $request){
        $commodity_uid = $request->post('commodity_uid');
        $variety_uid = $request->post('variety_uid');
         
        $varieties = Variety::where('variety_uid',$variety_uid)->where('commodity_uid',$commodity_uid)->get();
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        if (count($varieties) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return VarietyResource::collection($varieties)->additional($additional);
    }
     /**
     * Function for getting all trades
     *
     * @return void
     */
    public function getAllTrades()
    {

        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $query = Trade::where('valid_to','>=',date('Y-m-d'))->where('unique_user_id','!=',$user->unique_user_id);
        if(isset($_GET['commodity_uid'])){
            $commodity_uid=$_GET['commodity_uid'];
            if($commodity_uid!=""){
               $query=  $query->where('commodity_uid', $commodity_uid);
             }
         }
         if(isset($_GET['variety_uid'])){
            $variety_uid=$_GET['variety_uid'];
            if($variety_uid!=""){
               $query=  $query->where('variety_uid', $variety_uid);
             }
         }
         if(isset($_GET['city_uid'])){
            $city_uid=$_GET['city_uid'];
            if($city_uid!=""){
               $query=  $query->where('city_uid', $city_uid);
             }
         }
         $trades = $query->orderBy('updated_at','DESC')->get();
        if (count($trades) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return TradeResource::collection($trades->load('commodity', 'variety', 'state', 'city', 'pincode', 'country'))->additional($additional);
    }
    // search trade
    public function searchTrades(Request $request){
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
       
        $commodity_uid = array();
        $variety_uid = array();
        $city_uid = array();
        if(isset($_GET['search'])){
            $search=$_GET['search'];
            if($search!=""){
               
                $commodity = Commodity::Where('name', 'LIKE','%'.$search.'%')->get();
                $commodity_uid = $commodity->pluck('commodity_uid')->toArray();

                $variety = Variety::Where('variety_name', 'LIKE','%'.$search.'%')->get();
                $variety_uid = $variety->pluck('variety_uid')->toArray();
                
                $city = City::Where('city_name', 'LIKE','%'.$search.'%')->get();
                $city_uid = $city->pluck('city_uid')->toArray();
             }
             if(isset($_GET['type'])){
                $type=$_GET['type'];
                if($type!=""){ 
                    if($type == 'my'){
                    $query = Trade::where('unique_user_id',$user->unique_user_id);
                    }else{
                    $query = Trade::where('unique_user_id','!=',$user->unique_user_id)->where('valid_to','>=',date('Y-m-d'));
                    }
                }else{
                    $query = Trade::where('unique_user_id','!=',$user->unique_user_id)->where('valid_to','>=',date('Y-m-d'));
                }
            }else{
                $query = Trade::where('unique_user_id','!=',$user->unique_user_id)->where('valid_to','>=',date('Y-m-d'));
            }
            if(count($commodity_uid) > 0){
                $query = $query->whereIn('commodity_uid',$commodity_uid);
            }
            if(count($variety_uid) > 0){
                $query = $query->whereIn('variety_uid',$variety_uid);
            }
            if(count($city_uid) > 0){
                $query = $query->whereIn('city_uid',$city_uid);
            }
            if((count($commodity_uid)  != 0) || (count($city_uid)  != 0) || (count($variety_uid)  != 0)){
            $trades = $query->orderBy('updated_at','DESC')->get();
            if (count($trades) <= 0) {
                return response()->json(['success' => false, 'message' => "Data not available"], 200);
            }
            return TradeResource::collection($trades->load('commodity', 'variety', 'state', 'city', 'pincode', 'country'))->additional($additional);
        }else{
            return response()->json(['success' => false, 'message' => "No such trade found!"], 200);
        
        }
    }else{
            return response()->json(['success' => false, 'message' => "No such trade found!"], 200);
        
        }
        
       
    }
    // to create bid
    public function createBid(Request $request){
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $data = $request->validate([
            'price' => 'required|string',
            'quantity' => 'required',
            'trade_uid' => 'nullable|required|string|exists:trades,trade_uid,deleted_at,NULL',
        ],[
            'trade_uid.exists' =>'Trade Doesnot exists',
        ]);
        $getvariety = Trade::where('trade_uid',$data['trade_uid'])->first();
        if($data['price'] < $getvariety->variety->from_price){
            $data = [
                'success' => false,
                'message' => 'Price Should be greater than '. $getvariety->variety->from_price,
            ];
            return response()->json($data, 200); die;
        }
        if($data['price'] > $getvariety->variety->to_price){
            $data = [
                'success' => false,
                'message' => 'Price Should be less than '. $getvariety->variety->to_price,
            ];
            return response()->json($data, 200); die;
        }
        $data['bid_uid'] = get_random_id('bids', 'bid_uid');
        $data['unique_user_id'] = $user->unique_user_id;
        $data['user_type'] = $user->user_type;
        $data['status'] = 'pending';
        $bid = Bid::create($data);
        $notification = array();
        $notification['notification_uid'] = get_random_id('notifications', 'notification_uid');
        $notification['unique_user_id']=$getvariety->unique_user_id;
        $notification['seen']=0;
        $titleget="Congratulations!";
        $type1="individual";
        $msg  =  $notification['message']='Bid Requested on your trade';
        Notification::insert($notification);
        Helpers::sendnotification($titleget,$msg,'',$getvariety->unique_user_id);
        $additional = [
            'success' => true,
            'message' => 'Bid Placed successfully',
        ];
        return (new BidResource($bid->load('trade','user')))->additional($additional);

    }
    // to view bid status trader and farmer app both
    public function viewBidStatus(){
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $bids = Bid::where('unique_user_id',$user->unique_user_id)->get();
        if (count($bids) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return BidResource::collection($bids->load('trade','user'))->additional($additional);

    }
    // to view bid Requests
    public function viewBidRequests(){
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }

        $trades = Trade::where('unique_user_id',$user->unique_user_id)->where('deleted_at',NULL)->get();
        $tradeuids = $trades->pluck('trade_uid')->toArray();

        $bids = Bid::where('status','pending')->whereIn('trade_uid',$tradeuids)->get();
        if (count($bids) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return BidResource::collection($bids->load('trade','user'))->additional($additional);

    }

    // to view bid Requests
    public function viewBidsAcceptOrReject(){
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $trades = Trade::where('unique_user_id',$user->unique_user_id)->where('deleted_at',NULL)->get();
        $tradeuids = $trades->pluck('trade_uid')->toArray();

        $bids = Bid::where('status','!=','pending')->whereIn('trade_uid',$tradeuids)->get();
        if (count($bids) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return BidResource::collection($bids->load('trade','user'))->additional($additional);

    }
    /**
     * Delete bid details
     *
     * @param Request $request
     * @return void
     */
    public function deleteBidRequest($bid_uid)
    {
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $bid_detail = Bid::where(['unique_user_id' => $user->unique_user_id, 'bid_uid' => $bid_uid])->first();
        if (!$bid_detail) {
            return response()->json(['success' => false, 'message' => 'Please provide valid bid detail Id as Param!'], 200);
        }

        $bid_detail->deleted_by = Auth::user()->id;
        $bid_detail->save();
        $bid_detail->delete();

        return response()->json(['success' => true, 'message' => 'bid details has been deleted successfully!'], 200);
    }
    public function bidAction(Request $request){

        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        if(!$request->post('status')){
            $data = [
                'success' => false,
                'message' => 'Status is required',
            ];
            return response()->json($data, 200); die;
        }
        if(!$request->post('bid_uid')){
            $data = [
                'success' => false,
                'message' => 'Bid_uid is required',
            ];
            return response()->json($data, 200); die;
        }
        $finaldata = array();
        $bid_uid = $request->post('bid_uid');
        $status = $request->post('status');
        $finaldata['status_by'] = $user->unique_user_id;
        $finaldata['status_date'] = date('Y-m-d');
        $finaldata['status'] = $status;
        if($status == 'rejected'){
            if($request->post('comment')){
               $finaldata['comment'] = $request->post('comment');
            }else{
                $data = [
                    'success' => false,
                    'message' => 'Comment is required in case of reject ',
                ];
                return response()->json($data, 200); die;
            }
        }
        Bid::where('bid_uid',$bid_uid)->update($finaldata);
        return response()->json(['success' => true, 'message' => 'bid '.$status.' successfully!'], 200);

    }
     // to view bid status by other traders in trader app
     public function viewBidReceived(){
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $bids = Bid::where('unique_user_id','!=',$user->unique_user_id)->Orderby('updated_at','DESC')->get();
        if (count($bids) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return BidResource::collection($bids->load('trade','user'))->additional($additional);

    }
    // to view bid status by other traders in trader app
    public function viewBidCreated(){
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $bids = Bid::where('unique_user_id',$user->unique_user_id)->where('status','pending')->Orderby('updated_at','DESC')->get();
        if (count($bids) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return BidResource::collection($bids->load('trade','user'))->additional($additional);

    }
    // to fetch process methods
    public function getProcessMethods(){
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $process = ProcessMethod::where('deleted_at',NULL)->get();
        if (count($process) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return ProcessMethodResource::collection($process->load('commodity'))->additional($additional);

    }
     // to fetch farm factors
     public function getFarmFactor(){
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $farm = FarmFactor::where('deleted_at',NULL)->get();
        if (count($farm) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return FarmFactorResource::collection($farm)->additional($additional);

    }

     // to fetch process capacity
     public function getProcessCapacity(){
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $query = ProcessCapability::where('deleted_at',NULL);
        if(isset($_GET['commodity_uid'])){
            $commodity_uid=$_GET['commodity_uid'];
            if($commodity_uid!=""){
            $query = $query->where('commodity_uid', $commodity_uid);
            }
        }
        $processcapability = $query->get();
        if (count($processcapability) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return ProcessCapabilityResource::collection($processcapability->load('commodity'))->additional($additional);
    }
    // to create bid
    public function bidUpdate(Request $request){
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $data = $request->validate([
            'price' => 'required|string',
            'quantity' => 'required',
            'bid_uid' => 'nullable|required|string|exists:bids,bid_uid,deleted_at,NULL',
        ],[
            'bid_uid.exists' =>'Bid Doesnot exists',
        ]);
        $getbid = Bid::where('bid_uid',$data['bid_uid'])->first();

        $getvariety = Trade::where('trade_uid',$getbid->trade_uid)->first();
        if($data['price'] < $getvariety->variety->from_price){
            $data = [
                'success' => false,
                'message' => 'Price Should be greater than '. $getvariety->variety->from_price,
            ];
            return response()->json($data, 200); die;
        }
        if($data['price'] > $getvariety->variety->to_price){
            $data = [
                'success' => false,
                'message' => 'Price Should be less than '. $getvariety->variety->to_price,
            ];
            return response()->json($data, 200); die;
        }
        $data['unique_user_id'] = $user->unique_user_id;
        $data['user_type'] = $user->user_type;
        $data['status'] = 'pending';
        Bid::where('bid_uid',$data['bid_uid'])->update($data);

        $additional = [
            'success' => true,
            'message' => 'Bid Placed successfully',
        ];
        return response()->json($additional, 200); die;

    }
    public function getNotification(Request $request){
        $user = Auth::user();
        if (!$user->unique_user_id) {
            return response()->json(['success' => false, 'message' => "User is not registered"], 200);
        }
        $additional = [
            'success' => true,
            'message' => 'Data Fetched successfully',
        ];
        $notification = Notification::where('unique_user_id',$user->unique_user_id)->get();
        if (count($notification) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return NotificationResource::collection($notification)->additional($additional);
    
    }
}
