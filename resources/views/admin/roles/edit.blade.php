@extends('admin.layouts.master')
@section('title')
    @include('admin.roles.partials.title')
@endsection
@section('styles')

@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.roles.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body"> n
            @include('admin.layouts.partials.messages')
                <form action="{{ route('edit-role',$data->role_uid) }}" method="POST" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Role Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>  
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Is Superadmin <span class="text-danger">*</span></label>
                            <input type="checkbox" name="issuperadmin" id="issuperadmin" value="*">  
                           
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-bordered inner-table" id="">
                                <tr>
                                    <th >Privileges</th>
                                    <th >None</th>
                                    <th>Read</th>
                                    <th >Write</th>
                                    <th >Update</th>
                                    <th >Delete</th>
                                </tr>
                        <tboby>
                            <tr>
                                <td>Dashboard</td>
                                <td><input type="checkbox" value="
                                "  name="dashboard_none"></td>
                                <td><input type="checkbox" <?php if(in_array('DashboardController@dashboard',$permissions)){echo 'checked';}?> value="DashboardController@dashboard
                                "  name="dashboard_read"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Users Module</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>Farmers</td>
                                <td><input type="checkbox" value="
                                "  name="user_farmer_none"></td>
                                <td><input type="checkbox"  <?php if(in_array('FarmerController@index',$permissions)){echo 'checked';}?> value="FarmerController@index
                                "  name="user_farmer_read"></td>
                                <td><input type="checkbox"  <?php if(in_array('FarmerController@create',$permissions)){echo 'checked';}?> value="FarmerController@create,FarmerController@store
                                "  name="user_farmer_write"></td>
                                <td><input type="checkbox"  <?php if(in_array('FarmerController@edit',$permissions)){echo 'checked';}?> value="FarmerController@edit,FarmerController@update
                                "  name="user_farmer_update"></td>
                                <td><input type="checkbox"  <?php if(in_array('FarmerController@destroy',$permissions)){echo 'checked';}?> value="FarmerController@destroy
                                "  name="user_farmer_delete"></td>
                            </tr>
                            <tr>
                                <td>FPO</td>
                                <td><input type="checkbox" value="
                                "  name="user_fpo_none"></td>
                                <td><input type="checkbox"  <?php if(in_array('FpoController@index',$permissions)){echo 'checked';}?> value="FpoController@index
                                "  name="user_fpo_read"></td>
                                <td><input type="checkbox"  <?php if(in_array('FpoController@create',$permissions)){echo 'checked';}?> value="FpoController@create,FpoController@store
                                "  name="user_fpo_write"></td>
                                <td><input type="checkbox"  <?php if(in_array('FpoController@edit',$permissions)){echo 'checked';}?> value="FpoController@edit,FpoController@update
                                "  name="user_fpo_update"></td>
                                <td><input type="checkbox"  <?php if(in_array('FpoController@destroy',$permissions)){echo 'checked';}?> value="FpoController@destroy
                                "  name="user_fpo_delete"></td>
                            </tr>
                            <tr>
                                <td>Trader</td>
                                <td><input type="checkbox" value="
                                "  name="user_trader_none"></td>
                                <td><input type="checkbox"  <?php if(in_array('TraderController@destroy',$permissions)){echo 'checked';}?>  value="TraderController@index
                                "  name="user_trader_read"></td>
                                <td><input type="checkbox"  <?php if(in_array('TraderController@destroy',$permissions)){echo 'checked';}?>  value="TraderController@create,TraderController@store
                                "  name="user_trader_write"></td>
                                <td><input type="checkbox"  <?php if(in_array('TraderController@destroy',$permissions)){echo 'checked';}?>  value="TraderController@edit,TraderController@update
                                "  name="user_trader_update"></td>
                                <td><input type="checkbox"  <?php if(in_array('TraderController@destroy',$permissions)){echo 'checked';}?>  value="TraderController@destroy
                                "  name="user_trader_delete"></td>
                            </tr>
                            <tr>
                                <td>Processor</td>
                                <td><input type="checkbox" value="
                                "  name="user_processor_none"></td>
                                <td><input type="checkbox" <?php if(in_array('ProcessorController@index',$permissions)){echo 'checked';}?>  value="ProcessorController@index
                                "  name="user_processor_read"></td>
                                <td><input type="checkbox" <?php if(in_array('ProcessorController@create',$permissions)){echo 'checked';}?>  value="ProcessorController@create,ProcessorController@store
                                "  name="user_processor_write"></td>
                                <td><input type="checkbox" <?php if(in_array('ProcessorController@edit',$permissions)){echo 'checked';}?>  value="ProcessorController@edit,ProcessorController@update
                                "  name="user_processor_update"></td>
                                <td><input type="checkbox" <?php if(in_array('ProcessorController@destroy',$permissions)){echo 'checked';}?>  value="ProcessorController@destroy
                                "  name="user_processor_delete"></td>
                            </tr>
                            <tr>
                                <th>KYC Module</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>Farmers</td>
                                <td><input type="checkbox" value="
                                "  name="kyc_farmer_none"></td>
                                <td><input type="checkbox"  <?php if(in_array('FarmerController@farmerKycList',$permissions)){echo 'checked';}?> value="FarmerController@farmerKycList,FarmerController@getFarmerKycById
                                "  name="kyc_farmer_read"></td>
                                <td></td>
                                <td><input type="checkbox"  <?php if(in_array('FarmerController@updateFarmerKycStatus',$permissions)){echo 'checked';}?> value="FarmerController@updateFarmerKycStatus
                                "  name="kyc_farmer_update"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>FPO</td>
                                <td><input type="checkbox" value="
                                "  name="kyc_fpo_none"></td>
                                <td><input type="checkbox" <?php if(in_array('FpoController@fpoKycList',$permissions)){echo 'checked';}?> value="FpoController@fpoKycList,FpoController@getFpoKycById
                                "  name="kyc_fpo_read"></td>
                                <td></td>
                                <td><input type="checkbox" <?php if(in_array('FpoController@updateFpoKycStatus',$permissions)){echo 'checked';}?> value="FpoController@updateFpoKycStatus
                                "  name="kyc_fpo_update"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Trader</td>
                                <td><input type="checkbox" value="
                                "  name="kyc_trader_none"></td>
                                <td><input type="checkbox" <?php if(in_array('TraderController@traderKycList',$permissions)){echo 'checked';}?> value="TraderController@traderKycList,TraderController@getTraderKycById
                                "  name="kyc_trader_read"></td>
                                <td></td>
                                <td><input type="checkbox" <?php if(in_array('TraderController@updateTraderKycStatus',$permissions)){echo 'checked';}?> value="TraderController@updateTraderKycStatus
                                "  name="kyc_trader_update"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Processor</td>
                                <td><input type="checkbox" value="
                                "  name="kyc_processor_none"></td>
                                <td><input type="checkbox" <?php if(in_array('ProcessorController@processorKycList',$permissions)){echo 'checked';}?> value="ProcessorController@processorKycList,ProcessorController@getProcessorKycById
                                "  name="kyc_processor_read"></td>
                                <td></td>
                                <td><input type="checkbox" <?php if(in_array('ProcessorController@updateProcessorKycStatus',$permissions)){echo 'checked';}?> value="ProcessorController@updateProcessorKycStatus
                                "  name="kyc_processor_update"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>General Module</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>Farm Factors</td>
                                <td><input type="checkbox" value="
                                "  name="farm_factor_none"></td>
                                <td><input type="checkbox" <?php if(in_array('FarmFactorController@index',$permissions)){echo 'checked';}?> value="FarmFactorController@index
                                "  name="farm_factor_read"></td>
                                <td><input type="checkbox" <?php if(in_array('FarmFactorController@create',$permissions)){echo 'checked';}?> value="FarmFactorController@create,FarmFactorController@store
                                "  name="farm_factor_write"></td>
                                <td><input type="checkbox" <?php if(in_array('FarmFactorController@edit',$permissions)){echo 'checked';}?> value="FarmFactorController@edit,FarmFactorController@update
                                "  name="farm_factor_update"></td>
                                <td><input type="checkbox" <?php if(in_array('FarmFactorController@destroy',$permissions)){echo 'checked';}?> value="FarmFactorController@destroy
                                "  name="farm_factor_delete"></td>
                            </tr>
                            <tr>
                                 
                                <td><input type="checkbox" value="
                                "  name="education_none"></td>
                                <td><input type="checkbox" <?php if(in_array('EducationController@index',$permissions)){echo 'checked';}?> value="EducationController@index
                                "  name="education_read"></td>
                                <td><input type="checkbox" <?php if(in_array('EducationController@create',$permissions)){echo 'checked';}?> value="EducationController@create,EducationController@store
                                "  name="education_write"></td>
                                <td><input type="checkbox" <?php if(in_array('EducationController@edit',$permissions)){echo 'checked';}?> value="EducationController@edit,EducationController@update
                                "  name="education_update"></td>
                                <td><input type="checkbox" <?php if(in_array('EducationController@destroy',$permissions)){echo 'checked';}?> value="EducationController@destroy
                                "  name="education_delete"></td>
                            </tr>
                            <tr>
                                <td>Process Capabilities</td>
                                <td><input type="checkbox"  value="
                                "  name="process_capabilities_none"></td>
                                <td><input type="checkbox" <?php if(in_array('ProcessCapabilityController@index',$permissions)){echo 'checked';}?> value="ProcessCapabilityController@index
                                "  name="process_capabilities_read"></td>
                                <td><input type="checkbox" <?php if(in_array('ProcessCapabilityController@create',$permissions)){echo 'checked';}?> value="ProcessCapabilityController@create,ProcessCapabilityController@store
                                "  name="process_capabilities_write"></td>
                                <td><input type="checkbox" <?php if(in_array('ProcessCapabilityController@edit',$permissions)){echo 'checked';}?> value="ProcessCapabilityController@edit,ProcessCapabilityController@update
                                "  name="process_capabilities_update"></td>
                                <td><input type="checkbox" <?php if(in_array('ProcessCapabilityController@destroy',$permissions)){echo 'checked';}?> value="ProcessCapabilityController@destroy
                                "  name="process_capabilities_delete"></td>
                            </tr>
                            <tr>
                                <td>Process Methods</td>
                                <td><input type="checkbox" value="
                                "  name="process_methods_none"></td>
                                <td><input type="checkbox"  <?php if(in_array('ProcessMethodController@index',$permissions)){echo 'checked';}?> value="ProcessMethodController@index
                                "  name="process_methods_read"></td>
                                <td><input type="checkbox"  <?php if(in_array('ProcessMethodController@create',$permissions)){echo 'checked';}?> value="ProcessMethodController@create,ProcessMethodController@store
                                "  name="process_methods_write"></td>
                                <td><input type="checkbox"  <?php if(in_array('ProcessMethodController@edit',$permissions)){echo 'checked';}?> value="ProcessMethodController@edit,ProcessMethodController@update
                                "  name="process_methods_update"></td>
                                <td><input type="checkbox" <?php if(in_array('ProcessMethodController@destroy',$permissions)){echo 'checked';}?>  value="ProcessMethodController@destroy
                                "  name="process_methods_delete"></td>
                            </tr>
                            <tr>
                                <td>WareHouse Type</td>
                                <td><input type="checkbox" value="
                                "  name="warehouse_none"></td>
                                <td><input type="checkbox" <?php if(in_array('WarehouseTypeController@index',$permissions)){echo 'checked';}?> value="WarehouseTypeController@index
                                "  name="warehouse_read"></td>
                                <td><input type="checkbox" <?php if(in_array('WarehouseTypeController@create',$permissions)){echo 'checked';}?> value="WarehouseTypeController@create,WarehouseTypeController@store
                                "  name="warehouse_write"></td>
                                <td><input type="checkbox" <?php if(in_array('WarehouseTypeController@edit',$permissions)){echo 'checked';}?> value="WarehouseTypeController@edit,WarehouseTypeController@update
                                "  name="warehouse_update"></td>
                                <td><input type="checkbox"  <?php if(in_array('WarehouseTypeController@destroy',$permissions)){echo 'checked';}?> value="WarehouseTypeController@destroy
                                "  name="warehouse_delete"></td>
                            </tr>
                            <th>location Module</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            </tr>
                            <tr>
                            <td>Countries</td>
                            <td><input type="checkbox" value="
                            "  name="countries_none"></td>
                            <td><input type="checkbox" <?php if(in_array('CountryController@index',$permissions)){echo 'checked';}?> value="CountryController@index
                            "  name="countries_read"></td>
                            <td><input type="checkbox" <?php if(in_array('CountryController@create',$permissions)){echo 'checked';}?> value="CountryController@create,CountryController@store
                            "  name="countries_write"></td>
                            <td><input type="checkbox" <?php if(in_array('CountryController@edit',$permissions)){echo 'checked';}?> value="CountryController@edit,CountryController@update
                            "  name="countries_update"></td>
                            <td><input type="checkbox" <?php if(in_array('CountryController@destroy',$permissions)){echo 'checked';}?>  value="CountryController@destroy
                            "  name="countries_delete"></td>
                            </tr>
                            <tr>
                            <td>States</td>
                            <td><input type="checkbox" value="
                            "  name="states_none"></td>
                            <td><input type="checkbox" <?php if(in_array('StateController@index',$permissions)){echo 'checked';}?> value="StateController@index
                            "  name="states_read"></td>
                            <td><input type="checkbox" <?php if(in_array('StateController@store',$permissions)){echo 'checked';}?> value="StateController@create,StateController@store
                            "  name="states_write"></td>
                            <td><input type="checkbox" <?php if(in_array('StateController@edit',$permissions)){echo 'checked';}?> value="StateController@edit,StateController@update
                            "  name="states_update"></td>
                            <td><input type="checkbox" <?php if(in_array('StateController@destroy',$permissions)){echo 'checked';}?> value="StateController@destroy
                            "  name="states_delete"></td>
                            </tr>
                            <tr>
                            <td>Cities</td>
                            <td><input type="checkbox" value="
                            "  name="cities_none"></td>
                            <td><input type="checkbox" <?php if(in_array('CityController@index',$permissions)){echo 'checked';}?> value="CityController@index
                            "  name="cities_read"></td>
                            <td><input type="checkbox" <?php if(in_array('CityController@create',$permissions)){echo 'checked';}?> value="CityController@create,CityController@store
                            "  name="cities_write"></td>
                            <td><input type="checkbox" <?php if(in_array('CityController@edit',$permissions)){echo 'checked';}?> value="CityController@edit,CityController@update
                            "  name="cities_update"></td>
                            <td><input type="checkbox" <?php if(in_array('CityController@destroy',$permissions)){echo 'checked';}?> value="CityController@destroy
                            "  name="cities_delete"></td>
                            </tr>
                            <tr>
                            <td>Pincodes</td>
                            <td><input type="checkbox" value="
                            "  name="pincodes_none"></td>
                            <td><input type="checkbox" <?php if(in_array('PincodeController@index',$permissions)){echo 'checked';}?> value="PincodeController@index
                            "  name="pincodes_read"></td>
                            <td><input type="checkbox" <?php if(in_array('PincodeController@create',$permissions)){echo 'checked';}?> value="PincodeController@create,PincodeController@store
                            "  name="pincodes_write"></td>
                            <td><input type="checkbox" <?php if(in_array('PincodeController@edit',$permissions)){echo 'checked';}?> value="PincodeController@edit,PincodeController@update
                            "  name="pincodes_update"></td>
                            <td><input type="checkbox" <?php if(in_array('PincodeController@destroy',$permissions)){echo 'checked';}?> value="PincodeController@destroy
                            "  name="pincodes_delete"></td>
                            </tr>
                            <tr>
                            <td>Districts</td>
                            <td><input type="checkbox" value="
                            "  name="districts_none"></td>
                            <td><input type="checkbox" <?php if(in_array('DistrictController@index',$permissions)){echo 'checked';}?> value="DistrictController@index
                            "  name="districts_read"></td>
                            <td><input type="checkbox" <?php if(in_array('DistrictController@create',$permissions)){echo 'checked';}?> value="DistrictController@create,DistrictController@store
                            "  name="districts_write"></td>
                            <td><input type="checkbox" <?php if(in_array('DistrictController@edit',$permissions)){echo 'checked';}?> value="DistrictController@edit,DistrictController@update
                            "  name="districts_update"></td>
                            <td><input type="checkbox" <?php if(in_array('DistrictController@destroy',$permissions)){echo 'checked';}?>  value="DistrictController@destroy
                            "  name="districts_delete"></td>
                            </tr>
                            <tr>
                            <td>Sub Districts</td>
                            <td><input type="checkbox" value="
                            "  name="subdistricts_none"></td>
                            <td><input type="checkbox" <?php if(in_array('SubDistrictController@index',$permissions)){echo 'checked';}?> value="SubDistrictController@index
                            "  name="subdistricts_read"></td>
                            <td><input type="checkbox" <?php if(in_array('SubDistrictController@create',$permissions)){echo 'checked';}?> value="SubDistrictController@create,SubDistrictController@store
                            "  name="subdistricts_write"></td>
                            <td><input type="checkbox" <?php if(in_array('SubDistrictController@edit',$permissions)){echo 'checked';}?> value="SubDistrictController@edit,SubDistrictController@update
                            "  name="subdistricts_update"></td>
                            <td><input type="checkbox" <?php if(in_array('SubDistrictController@destroy',$permissions)){echo 'checked';}?>  value="SubDistrictController@destroy
                            "  name="subdistricts_delete"></td>
                            </tr>
                            <tr>
                            <td>Villages</td>
                            <td><input type="checkbox" value="
                            "  name="villages_none"></td>
                            <td><input type="checkbox" <?php if(in_array('VillageController@index',$permissions)){echo 'checked';}?> value="VillageController@index
                            "  name="villages_read"></td>
                            <td><input type="checkbox"  <?php if(in_array('VillageController@create',$permissions)){echo 'checked';}?> value="VillageController@create,VillageController@store
                            "  name="villages_write"></td>
                            <td><input type="checkbox" <?php if(in_array('VillageController@edit',$permissions)){echo 'checked';}?> value="VillageController@edit,VillageController@update
                            "  name="villages_update"></td>
                            <td><input type="checkbox" <?php if(in_array('VillageController@destroy',$permissions)){echo 'checked';}?> value="VillageController@destroy
                            "  name="villages_delete"></td>
                            </tr>
                            <tr>
                            <td>Trades</td>
                            <td><input type="checkbox" value="
                            "  name="trades_none"></td>
                            <td><input type="checkbox" <?php if(in_array('OtherController@getAllTrades',$permissions)){echo 'checked';}?> value="OtherController@getAllTrades,OtherController@getTradeDetails
                            "  name="trades_read"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>
                            <tr>
                            <th>Service Module</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            </tr>
                            <tr>
                            <td>Services</td>
                            <td><input type="checkbox" value="
                            "  name="services_none"></td>
                            <td><input type="checkbox" <?php if(in_array('ServiceController@index',$permissions)){echo 'checked';}?> value="ServiceController@index
                            "  name="services_read"></td>
                            <td><input type="checkbox" <?php if(in_array('ServiceController@create',$permissions)){echo 'checked';}?> value="ServiceController@create,ServiceController@store
                            "  name="services_write"></td>
                            <td><input type="checkbox" <?php if(in_array('ServiceController@edit',$permissions)){echo 'checked';}?> value="ServiceController@edit,ServiceController@update
                            "  name="services_update"></td>
                            <td><input type="checkbox" <?php if(in_array('ServiceController@destroy',$permissions)){echo 'checked';}?> value="ServiceController@destroy
                            "  name="services_delete"></td>
                            </tr>
                            <tr>
                            <td>Service Allocations</td>
                            <td><input type="checkbox" value="
                            "  name="service_allocations_none"></td>
                            <td><input type="checkbox" <?php if(in_array('ServiceController@index',$permissions)){echo 'checked';}?> value="ServiceController@index
                            "  name="service_allocations_read"></td>
                            <td><input type="checkbox" <?php if(in_array('ServiceController@create',$permissions)){echo 'checked';}?> value="ServiceController@create,ServiceController@store
                            "  name="service_allocations_write"></td>
                            <td><input type="checkbox" <?php if(in_array('ServiceController@edit',$permissions)){echo 'checked';}?> value="ServiceController@edit,ServiceController@update
                            "  name="service_allocations_update"></td>
                            <td><input type="checkbox" <?php if(in_array('ServiceController@destroy',$permissions)){echo 'checked';}?> value="ServiceController@destroy
                            "  name="service_allocations_delete"></td>
                            </tr>
                            <tr>
                            <td>Procurment Report</td>
                            <td><input type="checkbox" value="
                            "  name="procurment_none"></td>
                            <td><input type="checkbox"  <?php if(in_array('ReportController@index',$permissions)){echo 'checked';}?> value="ReportController@index,ReportController@filter
                            "  name="procurment_read"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>
                            <tr>
                            <td>Feedback Module</td>
                            <td><input type="checkbox" value="
                            "  name="feedback_none"></td>
                            <td><input type="checkbox" <?php if(in_array('ReportController@feedbackList',$permissions)){echo 'checked';}?>  value="ReportController@feedbackList
                            "  name="feedback_read"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>
                            <tr>
                            <td>Marketing And Promo</td>
                            <td><input type="checkbox" value="
                            "  name="marketing_none"></td>
                            <td><input type="checkbox" <?php if(in_array('MarketingController@index',$permissions)){echo 'checked';}?>  value="MarketingController@index
                            "  name="marketing_read"></td>
                            <td><input type="checkbox" <?php if(in_array('MarketingController@create',$permissions)){echo 'checked';}?>  value="MarketingController@create,MarketingController@store
                            "  name="marketing_write"></td>
                            <td><input type="checkbox" <?php if(in_array('MarketingController@edit',$permissions)){echo 'checked';}?>  value="MarketingController@edit,MarketingController@update
                            "  name="marketing_update"></td>
                            <td><input type="checkbox" <?php if(in_array('MarketingController@destroy',$permissions)){echo 'checked';}?>  value="MarketingController@destroy
                            "  name="marketing_delete"></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-5">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection
