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
            <div class="card-body">
            @include('admin.layouts.partials.messages')
                <form action="{{ route('add-role') }}" method="POST" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
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
                                <td><input type="checkbox" value="DashboardController@dashboard
                                "  name="dashboard_read"></td>
                                <td><input type="checkbox" value="DashboardController@dashboard
                                "  name="dashboard_write"></td>
                                <td><input type="checkbox" value="DashboardController@dashboard
                                "  name="dashboard_update"></td>
                                <td><input type="checkbox" value="DashboardController@dashboard
                                "  name="dashboard_delete"></td>
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
                                <td><input type="checkbox" value="FarmerController@index
                                "  name="user_farmer_read"></td>
                                <td><input type="checkbox" value="FarmerController@create,FarmerController@store
                                "  name="user_farmer_write"></td>
                                <td><input type="checkbox" value="FarmerController@edit,FarmerController@update
                                "  name="user_farmer_update"></td>
                                <td><input type="checkbox" value="FarmerController@destroy
                                "  name="user_farmer_delete"></td>
                            </tr>
                            <tr>
                                <td>FPO</td>
                                <td><input type="checkbox" value="
                                "  name="user_fpo_none"></td>
                                <td><input type="checkbox" value="FpoController@index
                                "  name="user_fpo_read"></td>
                                <td><input type="checkbox" value="FpoController@create,FpoController@store
                                "  name="user_fpo_write"></td>
                                <td><input type="checkbox" value="FpoController@edit,FpoController@update
                                "  name="user_fpo_update"></td>
                                <td><input type="checkbox" value="FpoController@destroy
                                "  name="user_fpo_delete"></td>
                            </tr>
                            <tr>
                                <td>Trader</td>
                                <td><input type="checkbox" value="
                                "  name="user_trader_none"></td>
                                <td><input type="checkbox" value="TraderController@index
                                "  name="user_trader_read"></td>
                                <td><input type="checkbox" value="TraderController@create,TraderController@store
                                "  name="user_trader_write"></td>
                                <td><input type="checkbox" value="TraderController@edit,TraderController@update
                                "  name="user_trader_update"></td>
                                <td><input type="checkbox" value="TraderController@destroy
                                "  name="user_trader_delete"></td>
                            </tr>
                            <tr>
                                <td>Processor</td>
                                <td><input type="checkbox" value="
                                "  name="user_processor_none"></td>
                                <td><input type="checkbox" value="ProcessorController@index
                                "  name="user_processor_read"></td>
                                <td><input type="checkbox" value="ProcessorController@create,ProcessorController@store
                                "  name="user_processor_write"></td>
                                <td><input type="checkbox" value="ProcessorController@edit,ProcessorController@update
                                "  name="user_processor_update"></td>
                                <td><input type="checkbox" value="ProcessorController@destroy
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
                                <td><input type="checkbox" value="FarmerController@farmerKycList,FarmerController@getFarmerKycById
                                "  name="kyc_farmer_read"></td>
                                <td></td>
                                <td><input type="checkbox" value="FarmerController@updateFarmerKycStatus
                                "  name="kyc_farmer_update"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>FPO</td>
                                <td><input type="checkbox" value="
                                "  name="kyc_fpo_none"></td>
                                <td><input type="checkbox" value="FpoController@fpoKycList,FpoController@getFpoKycById
                                "  name="kyc_fpo_read"></td>
                                <td></td>
                                <td><input type="checkbox" value="FpoController@updateFpoKycStatus
                                "  name="kyc_fpo_update"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Trader</td>
                                <td><input type="checkbox" value="
                                "  name="kyc_trader_none"></td>
                                <td><input type="checkbox" value="TraderController@traderKycList,TraderController@getTraderKycById
                                "  name="kyc_trader_read"></td>
                                <td></td>
                                <td><input type="checkbox" value="TraderController@updateTraderKycStatus
                                "  name="kyc_trader_update"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Processor</td>
                                <td><input type="checkbox" value="
                                "  name="kyc_processor_none"></td>
                                <td><input type="checkbox" value="ProcessorController@processorKycList,ProcessorController@getProcessorKycById
                                "  name="kyc_processor_read"></td>
                                <td></td>
                                <td><input type="checkbox" value="ProcessorController@updateProcessorKycStatus
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
                                <td><input type="checkbox" value="FarmFactorController@index
                                "  name="farm_factor_read"></td>
                                <td><input type="checkbox" value="FarmFactorController@create,FarmFactorController@store
                                "  name="farm_factor_write"></td>
                                <td><input type="checkbox" value="FarmFactorController@edit,FarmFactorController@update
                                "  name="farm_factor_update"></td>
                                <td><input type="checkbox" value="FarmFactorController@destroy
                                "  name="farm_factor_delete"></td>
                            </tr>
                            <tr>
                                 
                                <td><input type="checkbox" value="
                                "  name="education_none"></td>
                                <td><input type="checkbox" value="EducationController@index
                                "  name="education_read"></td>
                                <td><input type="checkbox" value="EducationController@create,EducationController@store
                                "  name="education_write"></td>
                                <td><input type="checkbox" value="EducationController@edit,EducationController@update
                                "  name="education_update"></td>
                                <td><input type="checkbox" value="EducationController@destroy
                                "  name="education_delete"></td>
                            </tr>
                            <tr>
                                <td>Process Capabilities</td>
                                <td><input type="checkbox" value="
                                "  name="process_capabilities_none"></td>
                                <td><input type="checkbox" value="ProcessCapabilityController@index
                                "  name="process_capabilities_read"></td>
                                <td><input type="checkbox" value="ProcessCapabilityController@create,ProcessCapabilityController@store
                                "  name="process_capabilities_write"></td>
                                <td><input type="checkbox" value="ProcessCapabilityController@edit,ProcessCapabilityController@update
                                "  name="process_capabilities_update"></td>
                                <td><input type="checkbox" value="ProcessCapabilityController@destroy
                                "  name="process_capabilities_delete"></td>
                            </tr>
                            <tr>
                                <td>Process Methods</td>
                                <td><input type="checkbox" value="
                                "  name="process_methods_none"></td>
                                <td><input type="checkbox" value="ProcessMethodController@index
                                "  name="process_methods_read"></td>
                                <td><input type="checkbox" value="ProcessMethodController@create,ProcessMethodController@store
                                "  name="process_methods_write"></td>
                                <td><input type="checkbox" value="ProcessMethodController@edit,ProcessMethodController@update
                                "  name="process_methods_update"></td>
                                <td><input type="checkbox" value="ProcessMethodController@destroy
                                "  name="process_methods_delete"></td>
                            </tr>
                            <tr>
                                <td>WareHouse Type</td>
                                <td><input type="checkbox" value="
                                "  name="warehouse_none"></td>
                                <td><input type="checkbox" value="WarehouseTypeController@index
                                "  name="warehouse_read"></td>
                                <td><input type="checkbox" value="WarehouseTypeController@create,WarehouseTypeController@store
                                "  name="warehouse_write"></td>
                                <td><input type="checkbox" value="WarehouseTypeController@edit,WarehouseTypeController@update
                                "  name="warehouse_update"></td>
                                <td><input type="checkbox" value="WarehouseTypeController@destroy
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
                            <td><input type="checkbox" value="CountryController@index
                            "  name="countries_read"></td>
                            <td><input type="checkbox" value="CountryController@create,CountryController@store
                            "  name="countries_write"></td>
                            <td><input type="checkbox" value="CountryController@edit,CountryController@update
                            "  name="countries_update"></td>
                            <td><input type="checkbox" value="CountryController@destroy
                            "  name="countries_delete"></td>
                            </tr>
                            <tr>
                            <td>States</td>
                            <td><input type="checkbox" value="
                            "  name="states_none"></td>
                            <td><input type="checkbox" value="StateController@index
                            "  name="states_read"></td>
                            <td><input type="checkbox" value="StateController@create,StateController@store
                            "  name="states_write"></td>
                            <td><input type="checkbox" value="StateController@edit,StateController@update
                            "  name="states_update"></td>
                            <td><input type="checkbox" value="StateController@destroy
                            "  name="states_delete"></td>
                            </tr>
                            <tr>
                            <td>Cities</td>
                            <td><input type="checkbox" value="
                            "  name="cities_none"></td>
                            <td><input type="checkbox" value="CityController@index
                            "  name="cities_read"></td>
                            <td><input type="checkbox" value="CityController@create,CityController@store
                            "  name="cities_write"></td>
                            <td><input type="checkbox" value="CityController@edit,CityController@update
                            "  name="cities_update"></td>
                            <td><input type="checkbox" value="CityController@destroy
                            "  name="cities_delete"></td>
                            </tr>
                            <tr>
                            <td>Pincodes</td>
                            <td><input type="checkbox" value="
                            "  name="pincodes_none"></td>
                            <td><input type="checkbox" value="PincodeController@index
                            "  name="pincodes_read"></td>
                            <td><input type="checkbox" value="PincodeController@create,PincodeController@store
                            "  name="pincodes_write"></td>
                            <td><input type="checkbox" value="PincodeController@edit,PincodeController@update
                            "  name="pincodes_update"></td>
                            <td><input type="checkbox" value="PincodeController@destroy
                            "  name="pincodes_delete"></td>
                            </tr>
                            <tr>
                            <td>Districts</td>
                            <td><input type="checkbox" value="
                            "  name="districts_none"></td>
                            <td><input type="checkbox" value="DistrictController@index
                            "  name="districts_read"></td>
                            <td><input type="checkbox" value="DistrictController@create,DistrictController@store
                            "  name="districts_write"></td>
                            <td><input type="checkbox" value="DistrictController@edit,DistrictController@update
                            "  name="districts_update"></td>
                            <td><input type="checkbox" value="DistrictController@destroy
                            "  name="districts_delete"></td>
                            </tr>
                            <tr>
                            <td>Sub Districts</td>
                            <td><input type="checkbox" value="
                            "  name="subdistricts_none"></td>
                            <td><input type="checkbox" value="SubDistrictController@index
                            "  name="subdistricts_read"></td>
                            <td><input type="checkbox" value="SubDistrictController@create,SubDistrictController@store
                            "  name="subdistricts_write"></td>
                            <td><input type="checkbox" value="SubDistrictController@edit,SubDistrictController@update
                            "  name="subdistricts_update"></td>
                            <td><input type="checkbox" value="SubDistrictController@destroy
                            "  name="subdistricts_delete"></td>
                            </tr>
                            <tr>
                            <td>Villages</td>
                            <td><input type="checkbox" value="
                            "  name="villages_none"></td>
                            <td><input type="checkbox" value="VillageController@index
                            "  name="villages_read"></td>
                            <td><input type="checkbox" value="VillageController@create,VillageController@store
                            "  name="villages_write"></td>
                            <td><input type="checkbox" value="VillageController@edit,VillageController@update
                            "  name="villages_update"></td>
                            <td><input type="checkbox" value="VillageController@destroy
                            "  name="villages_delete"></td>
                            </tr>
                            <tr>
                            <td>Trades</td>
                            <td><input type="checkbox" value="
                            "  name="trades_none"></td>
                            <td><input type="checkbox" value="OtherController@getAllTrades,OtherController@getTradeDetails
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
                            <td><input type="checkbox" value="ServiceController@index
                            "  name="services_read"></td>
                            <td><input type="checkbox" value="ServiceController@create,ServiceController@store
                            "  name="services_write"></td>
                            <td><input type="checkbox" value="ServiceController@edit,ServiceController@update
                            "  name="services_update"></td>
                            <td><input type="checkbox" value="ServiceController@destroy
                            "  name="services_delete"></td>
                            </tr>
                            <tr>
                            <td>Service Allocations</td>
                            <td><input type="checkbox" value="
                            "  name="service_allocations_none"></td>
                            <td><input type="checkbox" value="ServiceController@index
                            "  name="service_allocations_read"></td>
                            <td><input type="checkbox" value="ServiceController@create,ServiceController@store
                            "  name="service_allocations_write"></td>
                            <td><input type="checkbox" value="ServiceController@edit,ServiceController@update
                            "  name="service_allocations_update"></td>
                            <td><input type="checkbox" value="ServiceController@destroy
                            "  name="service_allocations_delete"></td>
                            </tr>
                            <tr>
                            <td>Procurment Report</td>
                            <td><input type="checkbox" value="
                            "  name="procurment_none"></td>
                            <td><input type="checkbox" value="ReportController@index,ReportController@filter
                            "  name="procurment_read"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>
                            <tr>
                            <td>Feedback Module</td>
                            <td><input type="checkbox" value="
                            "  name="feedback_none"></td>
                            <td><input type="checkbox" value="ReportController@feedbackList
                            "  name="feedback_read"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>
                            <tr>
                            <td>Marketing And Promo</td>
                            <td><input type="checkbox" value="
                            "  name="marketing_none"></td>
                            <td><input type="checkbox" value="MarketingController@index
                            "  name="marketing_read"></td>
                            <td><input type="checkbox" value="MarketingController@create,MarketingController@store
                            "  name="marketing_write"></td>
                            <td><input type="checkbox" value="MarketingController@edit,MarketingController@update
                            "  name="marketing_update"></td>
                            <td><input type="checkbox" value="MarketingController@destroy
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
