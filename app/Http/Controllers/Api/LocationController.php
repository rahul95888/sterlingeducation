<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\DistrictResource;
use App\Http\Resources\PinCodeResource;
use App\Http\Resources\StateResource;
use App\Http\Resources\SubDistrictResource;
use App\Http\Resources\VillageResource;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Pincode;
use App\Models\State;
use App\Models\SubDistrict;
use App\Models\Village;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    /**
     * Get countries
     *
     * @return void
     */
    public function getCountries()
    {
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        $countries = Country::orderBy('country_name')->get();
        if (count($countries) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        return CountryResource::collection($countries)->additional($additional);
    }

    /**
     * Function for get states
     *
     * @return void
     */
    public function getStates(Request $request)
    {
        $country_uid = $request->country_uid;
        if (!$country_uid) {
            $states = State::get();
           // return response()->json(['success' => false, 'message' => 'Please provide valid country uid as Param!'], 200);
        }else{
            $states = State::where('country_uid', $country_uid)->get();
        }

        if (count($states) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        return StateResource::collection($states->load('country'))->additional($additional);
    }

    /**
     * Function for get cities
     *
     * @return void
     */
    public function getCities(Request $request)
    {
        $state_uid = $request->state_uid;
        if (!$state_uid) {
            $cities = City::get();
          //  return response()->json(['success' => false, 'message' => 'Please provide valid state uid as Param!'], 200);
        }else{
            $cities = City::where('state_uid', $state_uid)->get();
        }

        if (count($cities) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        return CityResource::collection($cities->load('state'))->additional($additional);
    }

    /**
     * Function for get pincodes
     *
     * @return void
     */
    public function getPincodes(Request $request)
    {
        $city_uid = $request->city_uid;
        if (!$city_uid) {
            return response()->json(['success' => false, 'message' => 'Please provide valid city uid as Param!'], 200);
        }

        $pincodes = Pincode::where('city_uid', $city_uid)->get();
        if (count($pincodes) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        return PinCodeResource::collection($pincodes->load('city'))->additional($additional);
    }

    /**
     * Function for get districts
     *
     * @return void
     */

    public function getDistricts(Request $request)
    {
        $state_uid = $request->state_uid;
        if (!$state_uid) {
            $districts = District::get();
           // return response()->json(['success' => false, 'message' => 'Please provide valid state uid as Param!'], 200);
        }else{
            $districts = District::where('state_uid', $state_uid)->get();
        }

        
        if (count($districts) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        return DistrictResource::collection($districts->load('state'))->additional($additional);
    }

    /**
     * Function for get sub districts
     *
     * @return void
     */
    public function getSubDistricts(Request $request)
    {
        $district_uid = $request->district_uid;
        if (!$district_uid) {
            return response()->json(['success' => false, 'message' => 'Please provide valid district uid as Param!'], 200);
        }

        $sub_districts = SubDistrict::where('district_uid', $district_uid)->get();
        if (count($sub_districts) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        return SubDistrictResource::collection($sub_districts->load('district'))->additional($additional);
    }

    /**
     * Function for get villages
     *
     * @return void
     */
    public function getVillages(Request $request)
    {
        $sub_district_uid = $request->sub_district_uid;
        if (!$sub_district_uid) {
            return response()->json(['success' => false, 'message' => 'Please provide valid sub district uid as Param!'], 200);
        }

        $villages = Village::where('sub_district_uid', $sub_district_uid)->get();
        if (count($villages) <= 0) {
            return response()->json(['success' => false, 'message' => "Data not available"], 200);
        }
        $additional = [
            'success' => true,
            'message' => 'Data fetched successfully',
        ];
        return VillageResource::collection($villages->load('subDistrict'))->additional($additional);
    }
}
