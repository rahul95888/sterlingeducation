<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OtherController;
use App\Http\Controllers\Api\CommonController;
use App\Http\Controllers\Api\LocationController;
use Illuminate\Http\Request;


//image upload test route
Route::post('upload_image', function (Request $request) {
    // $file = $request->file('image');
    // //doctype/id/imagename
    // $keyName = 'shreyansh1/bhavik';
    // return file_upload_on_aws($file, $keyName);

    $file = $request->image;
    //doctype/id/imagename
    $keyName = 'shreyansh1/bhavik1';
    return file_upload_on_aws_for_api($file, $keyName);
});
/**
 * Common api routes
 */
Route::post('send-otp', [AuthController::class, 'sendOtp']);
Route::post('verify-otp', [AuthController::class, 'verifyOtp']);

//Settings
Route::get('farm-factors', [CommonController::class, 'getFarmFactors']);
 

//Commodities
Route::get('commodities', [CommonController::class, 'getCommodities']);
//process methods
Route::get('process-methods',[CommonController::class,'getProcessMethods']);
// form factor
Route::get('form-factor',[CommonController::class,'getFarmFactor']);
//process capability
Route::get('process-capability',[CommonController::class,'getProcessCapacity']);
//Varieties
Route::get('varieties/{commodity_uid?}', [CommonController::class, 'getVarieties']);

//Equipments
Route::get('equipments', [CommonController::class, 'getEquipments']);

//Location routes
Route::get('countries', [LocationController::class, 'getCountries']);
Route::get('states/{country_uid?}', [LocationController::class, 'getStates']);
Route::get('cities/{state_uid?}', [LocationController::class, 'getCities']);
Route::get('pincodes/{city_uid?}', [LocationController::class, 'getPincodes']);
Route::get('districts/{state_uid?}', [LocationController::class, 'getDistricts']);
Route::get('sub-districts/{district_uid?}', [LocationController::class, 'getSubDistricts']);
Route::get('villages/{sub_district_uid?}', [LocationController::class, 'getVillages']);

//Marketing and banner images
Route::get('marketing-images', [CommonController::class, 'getMarketingImages']);

//Bank details
Route::get('bank-details/{ifsc_code?}', [CommonController::class, 'getBankDetails']);

Route::middleware('auth:user')->group(function () {
    //Auth
    Route::post('register-user', [AuthController::class, 'userRegistration']);

    //Get profile details
    Route::get('profile-details', [AuthController::class, 'getProfileDetails']);

    //update profile details
    Route::post('update-profile-details', [CommonController::class, 'updateProfileDetails']);

    //get crop details
    Route::get('crop-details', [AuthController::class, 'getCropDetails']);

    // add crop details 
    Route::post('add-crop',[CommonController::class,'addCropDetails']);
    //update user crop patterns
    Route::post('update-crop-details', [CommonController::class, 'updateCropDetails']);
    
    //delere user crop details
    Route::delete('delete-crop-details/{user_crop_detail_uid?}', [CommonController::class, 'DeleteCropDetails']);

    //get kyc details
    Route::get('kyc-details', [AuthController::class, 'getKycDetails']);

    //kyc details
    Route::post('add-kyc-details', [CommonController::class, 'addKycDetails']);
    Route::post('update-kyc-details', [CommonController::class, 'updateKycDetails']);

    //News
    Route::get('news', [CommonController::class, 'getNews']);

    //pops
    Route::get('pops', [CommonController::class, 'getPops']);
    Route::get('getPopCommodity', [CommonController::class, 'getPopCommodity']);
    

    //sections
    Route::get('sections/{commodity_uid}', [CommonController::class, 'getSections']);
    // notification
    Route::get('get-notification',[CommonController::class,'getNotification']);
    //trade
    Route::post('create-trade', [CommonController::class, 'createTrade']);
    Route::post('get-price', [CommonController::class, 'getPrice']);
    Route::get('my-trade', [CommonController::class, 'getMyTrades']);
    Route::get('all-trade',[CommonController::class,'getAllTrades']);
    Route::get('search-trade',[CommonController::class,'searchTrades']);
    Route::get('fetch-trade-details/{trade_uid}', [CommonController::class, 'fetchTradeDetails']);
    //bid
    Route::post('create-bid',[CommonController::class,'createBid']);
    Route::post('re-bid',[CommonController::class,'bidUpdate']);
    Route::get('bid-created',[CommonController::class,'viewBidCreated']);
    Route::get('my-bids-status',[CommonController::class,'viewBidStatus']);
    Route::get('bid-requests',[CommonController::class,'viewBidRequests']);
    Route::get('bid-approved',[CommonController::class,'viewBidsAcceptOrReject']);
    Route::delete('delete-bid/{delete_bid}',[CommonController::class,'deleteBidRequest']);
    Route::post('update-bid-status',[CommonController::class,'bidAction']);
    Route::get('bid-received',[CommonController::class,'viewBidReceived']);
    //Feedback
    Route::post('feedback', [OtherController::class, 'postFeedback']);

    //Commodities
    Route::get('user-commodities', [CommonController::class, 'getUserCommodities']);

    //Weather
    Route::get('weather', [CommonController::class, 'getWeather']);

    //Market Price
    Route::get('market-price', [CommonController::class, 'getMarketPrice']);

    //clear token
    Route::post('logout', [AuthController::class, 'logout']);
});
