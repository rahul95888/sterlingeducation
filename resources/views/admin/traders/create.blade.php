@extends('admin.layouts.master')
@section('title')
    @include('admin.traders.partials.title')
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
@endsection
@section('admin-content')
    <div class="page-wrapper">
        <div class="page-content">
            @include('admin.traders.partials.header-breadcrumbs')
            <div class="card">
                <div class="card-body">
                    @include('admin.layouts.partials.messages')
                    <form action="{{ route('traders.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first"  class="row g-3 needs-validation @if($errors->any())was-validated @endif"  autocomplete="off">
                        @csrf
                        <h5 class="mb-0">Basic Details</h5>
                        <hr>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label" for="mobile_number">Mobile Number <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" onkeypress="return /[0-9 ]/i.test(event.key)" name="mobile_number" required id="mobile_number" value="{{ old('mobile_number') }}">
                                @error('mobile_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required id="name" value="{{ old('name') }}" >
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label" for="company_name">Company Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="company_name" required id="company_name" value="{{ old('company_name') }}" >
                                @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label" for="email">Email </label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label" for="address">Address<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address" required id="address" value="{{ old('address') }}" >
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label" for="country_uid">Country <span class="text-danger">*</span></label>
                                <select class="form-control select2 country_uid select2" name="country_uid" required id="country_uid" >
                                    <option value="" disabled selected> Select Country</option>
                                    @if($countries)
                                        @foreach($countries as $country)
                                            <option value="{{ $country->country_uid }}" @if(old('country_uid') == $country->country_uid) selected @endif> {{$country->country_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('country_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label" for="state">State <span class="text-danger">*</span></label>
                                <select class="form-control state_uid select2" name="state_uid" required id="state" >
                                    <option value="" disabled selected> Select State</option>

                                </select>
                                @error('state_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label" for="district">District <span class="text-danger">*</span></label>
                                <select class="form-control district_uid select2" name="district_uid" required id="district" >
                                    <option value="" disabled selected> Select District</option>

                                </select>
                                @error('district_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label" for="sub_district">Sub District <span class="text-danger">*</span></label>
                                <select class="form-control sub_district_uid select2" name="sub_district_uid" required id="sub_district" >
                                    <option value="" disabled selected> Select Sub District</option>

                                </select>
                                @error('sub_district_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label" for="village">Village <span class="text-danger">*</span></label>
                                <select class="form-control village_uid select2" name="village_uid" required id="village" >
                                    <option value="" selected> Select Village</option>

                                </select>
                                @error('village_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="city">City <span class="text-danger">*</span></label>
                            <select class="form-control city_uid select2" name="city_uid" required id="city_uid" >
                                <option value="" disabled selected> Select City</option>

                            </select>
                            @error('city_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label" for="pincode_uid">Pincode <span class="text-danger">*</span></label>
                                <select class="form-control select2 pincode_uid" name="pincode_uid" required id="pincode_uid" >
                                    <option value="" disabled selected> Select Pincode</option>
                                    <!-- @if($pincodes)
                                        @foreach($pincodes as $pincode)
                                            <option value="{{ $pincode->pincode_uid }}" @if(old('pincode_uid') == $pincode->pincode_uid) selected @endif> {{$pincode->pincode}}</option>
                                        @endforeach
                                    @endif -->
                                </select>
                                @error('pincode_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <h5 class="mb-0">Other Details</h5>
                        <hr>
                        <div class="col-ms-12 row">
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="ho_location">HO Location <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="ho_location" id="ho_location" required>
                                @error('ho_location')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="branch_locations">Branch Locations<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="branch_locations" id="branch_locations" required>
                                <option value="" selected> Select Branch Location</option>
                                @if($districts)
                                        @foreach($districts as $district)
                                            <option value="{{ $district->district_uid }}"> {{$district->district_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('branch_locations')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="job_works">Job Works</label>
                                <input type="text" class="form-control" name="job_works" id="job_works">
                                @error('job_works')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> -->
                                <!-- <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label class="form-label" for="process_method_uid">Process Methods</label>
                                        <select class="form-control select2" name="process_method_uid" placeholder="Select Method" id="process_method_uid">
                                        <option value="" selected> Select Process Method</option>
                                        @if($process_methods)
                                                @foreach($process_methods as $process_method)
                                                    <option value="{{ $process_method->process_method_uid }}"> {{$process_method->process_method_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('process_method_uid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> -->
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label class="form-label" for="mandi_registration_details">Mandi Registration Details <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="mandi_registration_details" id="mandi_registration_details" required>
                                        @error('mandi_registration_details')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <h5 class="mb-0">Crop Details</h5>
                        <hr>
                        <div class="col-md-12" id="cropPattern">
                            <div class="row crop-class" >
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label" for="commodity_uid">Commodity <span class="text-danger">*</span></label>
                                        <select class="form-control commodity_uid  select2" required name="commodity_uid[]" id="commodity_uid" >
                                            <option value="" selected> Select Commodity</option>
                                            @if($commodities)
                                                @foreach($commodities as $key =>  $commodity)
                                                    <option value="{{ $commodity->commodity_uid }}" data-index="{{ $key }}"> {{$commodity->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('commodity_uid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="variety_uid">Variety <span class="text-danger">*</span></label>
                                        <select class="form-control variety_uid  select2" name="variety_uid[]" id="variety_uid" required>
                                            <option value="" selected> Select Variety</option>
                                        </select>
                                        @error('variety_uid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="form_factor">Form Factor <span class="text-danger">*</span></label>
                                        <select class="form-control  select2" name="form_factor[]" id="form_factor" required >
                                            <option value="" selected> Select Form Factor</option>
                                            @if($formfactor)
                                                @foreach($formfactor as $val)
                                                    <option value="{{ $val->farm_factor_uid }}"> {{$val->farm_factor_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('form_factor')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="tonnage_daily">Tonnage Daily <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="tonnage_daily[]" id="tonnage_daily" onkeypress="return isFloat(event);" required>
                                        @error('tonnage_daily')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="tonnage_monthly">Tonnage Monthly<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="tonnage_monthly[]" id="tonnage_monthly" onkeypress="return isFloat(event);" required>
                                        @error('tonnage_monthly')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="tonnage_yearly">Tonnage Yearly<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="tonnage_yearly[]" id="tonnage_yearly" onkeypress="return isFloat(event);" required>
                                        @error('tonnage_yearly')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="state_uid">State <span class="text-danger">*</span></label>
                                        <select class="form-control state_uid_crop select2" name="states[]" id="state_uid" required >
                                            <option value="" disabled selected> Select State</option>
                                            @if($states)
                                                @foreach($states as $state)
                                                    <option value="{{ $state->state_uid }}"> {{$state->state_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('state_uid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="district_uid">District <span class="text-danger">*</span></label>
                                        <select class="form-control district_uid_crop  select2" name="districts[]" id="district_uid" required>
                                            <option value="" disabled selected> Select District</option>
                                          {{--  @if($districts)
                                                @foreach($districts as $district)
                                                    <option value="{{ $district->district_uid }}"> {{$district->district_name}}</option>
                                                @endforeach
                                            @endif--}}
                                        </select>
                                        @error('district_uid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="sub_district_uid">Sub District <span class="text-danger">*</span></label>
                                        <select class="form-control sub_district_uid_crop  select2" name="sub_districts[]" id="sub_district_uid" required>
                                            <option value="" disabled selected> Select Sub District</option>
{{--                                            @if($sub_districts)--}}
{{--                                                @foreach($sub_districts as $sub_district)--}}
{{--                                                    <option value="{{ $sub_district->sub_district_uid }}" @if(old('sub_district_uid') == $sub_district->sub_district_uid) selected @endif> {{$sub_district->sub_district_name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            @endif--}}
                                        </select>
                                        @error('sub_district_uid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="village_uid">Village <span class="text-danger">*</span></label>
                                        <select class="form-control village_uid_crop  select2" name="villages[]" id="village_uid" required>
                                            <option value="" selected> Select Village</option>
{{--                                            @if($villages)--}}
{{--                                                @foreach($villages as $village)--}}
{{--                                                    <option value="{{ $village->village_uid }}" @if(old('village_uid') == $village->village_uid) selected @endif> {{$village->village_name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            @endif--}}
                                        </select>
                                        @error('village_uid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="process_method_uid">Process Methods <span class="text-danger">*</span></label>
                                        <select class="form-control select2" name="process_method_uid[]" id="process_method_uid" required>
                                        <option value="" selected> Select Process Method</option>
                                       
                                        @if($process_methods)
                                                @foreach($process_methods as $process_method)
                                                    <option value="{{ $process_method->process_method_uid }}"> {{$process_method->process_method_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('process_method_uid')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                            </div>
                            <!-- <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="process_capability_uid">Process Capability</label>
                                        <select class="form-control select2" name="process_capability_uid[]" id="process_capability_uid" >

                                            @if($process_capability)
                                                @foreach($process_capability as $capability)
                                                    <option value="{{ $capability->process_capability_uid }}"> {{$capability->process_capability_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('process_capability_uid')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                            </div> -->
                            </div>
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="button" class="btn btn-primary px-5" id="addNewCrop"><i class="bx bx-plus"></i>Add</button>
                            <button type="button" class="btn btn-primary px-5 remove-crop d-none" id="removeCrop"><i class="bx bx-minus"></i>Remove</button>
                        </div>
                        <h5 class="mb-0">Procurement Details</h5>
                        <span class="text-info">( All the fields are mandatory if one input present )</span>
                        <hr>
                        <div class="col-md-12" id="procurementDetail">
                            <div class="row procurement-class" >
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="warehouse_address">Warehouse Address</label>
                                        <input type="text" class="form-control" name="warehouse_address[]" id="warehouse_address">
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="warehouse_capacity">Warehouse Capacity</label>
                                        <input type="text" onkeypress="return isFloat(event);" class="form-control" name="warehouse_capacity[]" id="warehouse_capacity">
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="warehouse_type_uid">Warehouse Type</label>
                                        <select class="form-control select2" name="warehouse_type_uid[]" id="warehouse_type_uid">
                                            <option value="" disabled selected> Select Warehouse Type</option>
                                            @if($warehouse_types)
                                                @foreach($warehouse_types as $warehouse_type)
                                                    <option value="{{ $warehouse_type->warehouse_type_uid }}"> {{$warehouse_type->warehouse_type_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="procurement_state_uid">State</label>
                                        <select class="form-control state_uid_procurement select2" name="procurement_states[]" id="procurement_state_uid">
                                            <option value="" disabled selected> Select State</option>
                                            @if($states)
                                                @foreach($states as $state)
                                                    <option value="{{ $state->state_uid }}"> {{$state->state_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="procurement_district_uid">District</label>
                                        <select class="form-control district_uid_procurement select2" name="procurement_districts[]" id="procurement_district_uid">
                                            <option value="" disabled selected> Select District</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="procurement_sub_district_uid">Sub District</label>
                                        <select class="form-control sub_district_uid_procurement select2" name="procurement_sub_districts[]" id="procurement_sub_district_uid">
                                            <option value="" disabled selected> Select Sub District</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="procurement_village_uid">Village</label>
                                        <select class="form-control village_uid_procurement select2" name="procurement_villages[]" id="procurement_village_uid">
                                            <option value="" selected disabled> Select Village</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="button" class="btn btn-primary px-5" id="addNewProcurement"><i class="bx bx-plus"></i>Add</button>
                            <button type="button" class="btn btn-primary px-5 remove-procurement d-none" id="removeProcurement"><i class="bx bx-minus"></i>Remove</button>
                        </div>
                        <h5 class="mb-0">Documents</h5>
                        <hr>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="gst_number">GST Number</label>
                                        <input type="text"  maxlength="15"   onkeypress="return /[A-Za-z 0-9]/i.test(event.key)" class="form-control" name="gst_number" id="gst_number" value="{{ old('gst_number') }}">
                                        @error('gst_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="gst_document">GST Document</label>
                                        <input type="file" class="form-control dropify" data-height="150" data-allowed-file-extensions="png jpg jpeg webp" id="gst_document" name="gst_document"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="account_number">Account Number</label>
                                        <input type="text"  maxlength="12" onkeypress="return /[0-9 ]/i.test(event.key)" class="form-control" name="account_number" id="account_number" value="{{ old('account_number') }}">
                                        @error('account_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="account_holder_name">Account Holder Name</label>
                                        <input type="text" class="form-control" name="account_holder_name" id="account_holder_name" value="{{ old('account_holder_name') }}">
                                        @error('account_holder_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="ifsc_code">IFSC Code</label>
                                        <input type="text" class="form-control ifsc_code" name="ifsc_code" id="ifsc_code" value="{{ old('ifsc_code') }}">
                                        <p style="display:none;color:red;" id="ifsc_error">Please enter a valid IFSC Code</p>
                                        @error('ifsc_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="bank_name">Bank Name</label>
                                        <input type="text" class="form-control" name="bank_name" id="bank_name" value="{{ old('bank_name') }}" readonly>
                                        @error('bank_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="branch_name">Branch Name</label>
                                        <input type="text" class="form-control" name="branch_name" id="branch_name" value="{{ old('branch_name') }}" readonly>
                                        @error('branch_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="bank_document">Bank Document</label>
                                        <input type="file" class="form-control dropify" data-height="150" data-allowed-file-extensions="png jpg jpeg webp" id="bank_document" name="bank_document"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="address_document_type">Address Document Type</label>
                                        <select class="form-control  select2" name="address_document_type" id="address_document_type" >
                                            <option value="" selected> Select Address Document Type</option>
                                            <option value="electricity" @if(old('address_document_type') == 'electricity') selected @endif> Electricity Document</option>
                                            <option value="gas" @if(old('address_document_type') == 'gas') selected @endif> Gas Bill</option>
                                            <option value="internet" @if(old('address_document_type') == 'internet') selected @endif> Internet Bill</option>
                                        </select>
                                        @error('address_document_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="address_document_id_number">ID Number</label>
                                        <input type="text" class="form-control" name="address_document_id_number" id="address_document_id_number" value="{{ old('address_document_id_number') }}">
                                        @error('address_document_id_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="address_document">Address Document</label>
                                        <input type="file" class="form-control dropify" data-height="150" data-allowed-file-extensions="png jpg jpeg webp" id="address_document" name="address_document"/>
                                    </div>
                                </div>
                            </div>
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
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script>
    $(function() {
        $('#gst_number').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
        
    });
</script>
    <script>
         function statechange(c){
        //     $('#sub_district_uid'+c).html('');
        //     $('#district_uid'+c).html('');
        //     $('#village_uid'+c).html('');  
        //     alert(this.value);
        //     getDistrictCrop('crop',this.value);
            }
        $(document).ready(function(){
            $(".dropify").dropify();
            // $('.select2').select2({
            //     theme: 'bootstrap4',
            //     width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            //     placeholder: $(this).data('placeholder'),
            //     allowClear: Boolean($(this).data('allow-clear')),
            // });
            let commodities = <?php echo json_encode($commodities); ?>;
            let states = <?php echo json_encode($states); ?>;
            let formfactor = <?php echo json_encode($formfactor); ?>;
            let districts = <?php echo json_encode($districts); ?>;
            let sub_districts = <?php echo json_encode($sub_districts); ?>;
            let villages = <?php echo json_encode($villages); ?>;
            let process_methods = <?php echo json_encode($process_methods); ?>;
            // let process_capability = <?php echo json_encode($process_capability); ?>;

            $(document).on('change','.commodity_uid',function () {
                let parent_id = $(this).val();
                if ($(this).val() != '' && $(this).val() != 'Select Commodity') {
                    let index = $(this).find(':selected').data('index');
                    let varieties = commodities[index].varieties;
                    let output = '<option value="">Select Variety</option>'
                    $.each(varieties, function (index, value) {
                        output +='<option value="' + value.variety_uid + '">' + value.variety_name + '</option>'
                    });
                    $(this).closest('.crop-class').find('.variety_uid').html(output);
                }
            });

            $('.commodity_uid').trigger('change');
            let count = 0;
            $("#addNewCrop").click(function(e) {
                $(".remove-crop").removeClass("d-none");
                count++;

                let output = '';
                output = '<div class="row next-referral crop-class"><hr class="mb-2 mt-2">';
                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="commodity_uid">Commodity <span class="text-danger">*</span></label>'
                output += '<select class="form-control commodity_uid select2" id="commodity_uid'+count+'" name="commodity_uid[]" required>'
                output += '<option value="" selected> Select Commodity</option>'
                $.each(commodities, function (index, value) {
                    output += '<option value="'+ value.commodity_uid +'" data-index="'+ index +'"> '+ value.name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="variety_uid">Variety <span class="text-danger">*</span></label>'
                output += '<select class="form-control variety_uid" name="variety_uid[]" id="variety_uid'+count+'" required>'
                output += '<option value="" selected> Select Variety</option>'
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="form_factor">Form Factor <span class="text-danger">*</span></label>'
                output += '<select class="form-control form_factor select2" name="form_factor[]" id="form_factor'+count+'" required>'
                output += '<option value="" selected> Select Form Factor</option>'
                $.each(formfactor, function (index, value) {
                    output += '<option value="'+ value.farm_factor_uid +'" data-index="'+ index +'"> '+ value.farm_factor_name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="tonnage_daily">Tonnage Daily <span class="text-danger">*</span></label>'
                output += '<input type="text" class="form-control" name="tonnage_daily[]" id="tonnage_daily" required onkeypress="return isFloat(event);"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="tonnage_monthly">Tonnage Monthly <span class="text-danger">*</span></label>'
                output += '<input type="text" class="form-control" name="tonnage_monthly[]" id="tonnage_monthly" required onkeypress="return isFloat(event);"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="tonnage_yearly">Tonnage Yearly <span class="text-danger">*</span></label>'
                output += '<input type="text" class="form-control" name="tonnage_yearly[]" id="tonnage_yearly" required onkeypress="return isFloat(event);"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="state_uid">State <span class="text-danger">*</span></label>'
                output += '<select class="form-control select2" name="states[]" id="state_uid'+count+'" onchange="statechange('+count+')"  required>'
                output += '<option value="" selected> Select State</option>'
                $.each(states, function (index, value) {
                    output += '<option value="'+ value.state_uid +'" data-index="'+ index +'"> '+ value.state_name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="district_uid">District <span class="text-danger">*</span></label>'
                output += '<select class="form-control select2" name="districts[]" id="district_uid'+count+'" required>'
                output += '<option value="" selected> Select District</option>'
                // $.each(districts, function (index, value) {
                //     output += '<option value="'+ value.district_uid +'" data-index="'+ index +'"> '+ value.district_name +'</option>'
                // });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="sub_district_uid">Sub District <span class="text-danger">*</span></label>'
                output += '<select class="form-control select2" name="sub_districts[]" id="sub_district_uid'+count+'" required>'
                output += '<option value="" selected> Select Sub District</option>'
                // $.each(sub_districts, function (index, value) {
                //     output += '<option value="'+ value.sub_district_uid +'" data-index="'+ index +'"> '+ value.sub_district_name +'</option>'
                // });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="village_uid">Village <span class="text-danger">*</span></label>'
                output += '<select class="form-control select2" name="villages[]" id="village_uid'+count+'" required>'
                output += '<option value="" selected> Select Village</option>'
                // $.each(villages, function (index, value) {
                //     output += '<option value="'+ value.village_uid +'" data-index="'+ index +'"> '+ value.village_name +'</option>'
                // });

                output += '</select></div></div>'
                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="process_method_uid">Process Methods <span class="text-danger">*</span></label>'
                output += '<select class="form-control process_method_uid select2" name="process_method_uid[]"  id="process_method_uid'+count+'" required><option value="" selected> Select Process Method</option>'
                $.each(process_methods, function (index, value) {
                    output += '<option value="'+ value.process_method_uid +'" data-index="'+ index +'"> '+ value.process_method_name +'</option>'
                });
                output += '</select></div></div>'

                
                // output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="process_capability_uid">Process Capability</label>'
                // output += '<select class="form-control process_capability_uid select2" name="process_capability_uid[]"  id="process_capability_uid'+count+'">'
                // $.each(process_capability, function (index, value) {
                //     output += '<option value="'+ value.process_capability_uid +'" data-index="'+ index +'"> '+ value.process_capability_name +'</option>'
                // });
                // output += '</select></div></div>'

                output += '</div>'

                $("#cropPattern").append(output);
                $('#' + 'commodity_uid' + count, '#cropPattern').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
                $('#' + 'variety_uid' + count, '#cropPattern').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
                $('#' + 'form_factor' + count, '#cropPattern').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
                $('#' + 'state_uid' + count, '#cropPattern').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
                $('#' + 'district_uid' + count, '#cropPattern').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
                $('#' + 'sub_district_uid' + count, '#cropPattern').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
                $('#' + 'village_uid' + count, '#cropPattern').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
                $('#' + 'branch_locations' + count, '#cropPattern').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
                $('#' + 'process_method_uid' + count, '#cropPattern').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            });
            $("body").on("click", ".remove-crop", function(e) {
                $(".next-referral").last().remove();
            });
            $('.select2').select2({ theme: 'bootstrap4'});

            $('.country_uid').on('change',function(){
                $('.state_uid').html('');
                $('.city_uid').html('');
               $('.district_uid').html('');
               $('.sub_district_uid').html('');
               $('.village_uid').html('');  
               $('.pincode_uid').html(''); 
                var country_uid = this.value;
                $.ajax({
                    url:"{{ url('state/fetch') }}",
                    type: 'POST',
                    data:{
                        country_uid : country_uid,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType:'json',
                    success:function(states){

                        console.log(states);
                        $(".state_uid").append('<option>Select State</option>');
                        $.each(states,function (key ,value){
                            $('.state_uid').append('<option value="'+value.state_uid +'">'+ value.state_name +'</option>');
                        });
                    }
                });

            });

            $('.state_uid').on('change',function(){
                $('.district_uid').html('');
               $('.sub_district_uid').html('');
               $('.city_uid').html('');
               $('.village_uid').html(''); 
               $('.pincode_uid').html('');  
                getDistrict('basic',this.value);
                getCity('basic',this.value);

            });
            $('.city_uid').on('change',function(){
                $('.pincode_uid').html('');
                getPincode('basic',this.value);

            });
            $('.state_uid_crop').on('change',function(){
                $('.sub_district_uid_crop').html('');
               $('.village_uid_crop').html('');  
                getDistrict('crop',this.value);
            });

            function getDistrictCrop(flag,value){
               $('#village_uid'+count).html('');  
               $('#district_uid'+count).html('');

                let state_uid= value;
                $.ajax({
                    url: "{{ url('district/fetch') }}",
                    type:"POST",
                    data:{
                        state_uid: state_uid,
                        _token:'{{ csrf_token() }}'
                    } ,
                    dataType:'json',
                    success:function(district){
                        console.log(district);
                        $('#district_uid'+count).append('<option> Select District </option>');
                        $.each(district,function(key, value){
                            $('#district_uid'+count).append('<option value="'+ value.district_uid +'">'+ value.district_name +'</option>')
                        });
                    }
                });
            }

            function getCity(flag,value){
                let state_uid= value;
                $.ajax({
                    url: "{{ url('cities/fetch') }}",
                    type:"POST",
                    data:{
                        state_uid: state_uid,
                        _token:'{{ csrf_token() }}'
                    } ,
                    dataType:'json',
                    success:function(city){
                            $('.city_uid').append('<option> Select City </option>');
                            $.each(city,function(key, value){
                                $('.city_uid').append('<option value="'+ value.city_uid +'">'+ value.city_name +'</option>')
                            });
                    }
                });
            }
            function getPincode(flag,value){
                let city_uid= value;
                $.ajax({
                    url: "{{ url('pincodes/fetch') }}",
                    type:"POST",
                    data:{
                         city_uid: city_uid,
                        _token:'{{ csrf_token() }}'
                    } ,
                    dataType:'json',
                    success:function(pincode){
                            $('.pincode_uid').append('<option> Select Pincode </option>');
                            $.each(pincode,function(key, value){
                                $('.pincode_uid').append('<option value="'+ value.pincode_uid +'">'+ value.pincode +'</option>')
                            });
                    }
                });
            }
            function getDistrict(flag,value){
              //  $('.village_uid').html('');  
                if(flag=='crop'){
                    $('.district_uid_crop').html('');
                }
                else{
                    $('.district_uid').html('');
                }

                let state_uid= value;
                $.ajax({
                    url: "{{ url('district/fetch') }}",
                    type:"POST",
                    data:{
                        state_uid: state_uid,
                        _token:'{{ csrf_token() }}'
                    } ,
                    dataType:'json',
                    success:function(district){
                        console.log(district);
                        if(flag=='crop'){
                            $('.district_uid_crop').append('<option> Select District </option>');
                            $.each(district,function(key, value){
                                $('.district_uid_crop').append('<option value="'+ value.district_uid +'">'+ value.district_name +'</option>')
                            });
                        }
                        else{
                            $('.district_uid').append('<option> Select District </option>');
                            $.each(district,function(key, value){
                                $('.district_uid').append('<option value="'+ value.district_uid +'">'+ value.district_name +'</option>')
                            });
                        }
                    }
                });
            }

            $('.district_uid').on('change',function(){
                getSubDestrict('basic',this.value);

            });
            $('.district_uid_crop').on('change',function(){
                getSubDestrict('crop',this.value);
            });

            function getSubDestrict(flag,value){
                if(flag=='crop'){
                    $('.sub_district_uid_crop').html('');
                }
                else{
                    $('.sub_district_uid').html('');
                }
                var district_uid = value;

                $.ajax({
                    url:"{{ url('sub-district') }}",
                    type: "POST",
                    data:{
                        district_uid: district_uid,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result){
                        if(flag=='crop') {
                            $(".sub_district_uid_crop").append("<option>Select Sub-District</option>");
                            $.each(result.subDistrict, function (key, value) {
                                $(".sub_district_uid_crop").append('<option value="' + value.sub_district_uid + '">' + value.sub_district_name + '</option>');
                            });
                        }else{
                            $(".sub_district_uid").append("<option>Select Sub-District</option>");
                            $.each(result.subDistrict, function (key,value){
                                $(".sub_district_uid").append('<option value="'+ value.sub_district_uid +'">'+ value.sub_district_name +'</option>');
                            });
                        }

                    }
                });
            }

            $('.sub_district_uid').on('change',function(){
                getVillage('basic',this.value);

            });
            $('.sub_district_uid_crop').on('change',function(){
                getVillage('crop',this.value);
            });

            function getVillage(flag,value){
                if(flag=='crop'){
                    $('.village_uid_crop').html('');
                }
                else{
                    $('.village_uid').html('');
                }
                var sub_district_uid =value;
                $.ajax({
                    url  : "{{ url('village/fetch') }}",
                    type : "POST",
                    data : {
                        sub_district_uid: sub_district_uid,
                        _token : '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result){
                       if(flag=='crop'){
                           $(".village_uid_crop").append("<option>Select Village</option>");
                           $.each(result.village,function (key,value) {
                               $(".village_uid_crop").append('<option value="'+ value.village_uid +'">'+ value.village_name +'</option>');
                           });
                       }else{
                           $(".village_uid").append("<option>Select Village</option>");
                           $.each(result.village,function (key,value) {
                               $(".village_uid").append('<option value="'+ value.village_uid +'">'+ value.village_name +'</option>');
                           });
                       }
                    }
                });
            }
            $("#ifsc_code").on('keyup keypress blur change',function(){
                this.value = this.value.toLocaleUpperCase();
                var ifsc_code =this.value;
                $('#bank_name').val('');
                $('#banch_name').val('');
                $.ajax({
                    url  : "{{ url('api/bank-details/') }}"+'/'+ifsc_code,
                    type : "get",
                    success:function(result){
                        if(result.success == true){
                            document.getElementById("ifsc_error").style.display = "none";
                            $("#bank_name").val(result['data'].bank);
                            $("#branch_name").val(result['data'].branch);
                        }else{
                            document.getElementById("ifsc_error").style.display = "block";
                            $("#bank_name").val('');
                            $("#branch_name").val('');
                        }
                    }
                });
            });

            // procurement
            $('#procurement_state_uid').on('change',function(){
                $('#procurement_district_uid').html('');
                let procurement_state_uid= this.value;
                $.ajax({
                   url: "{{ url('district/fetch') }}",
                   type:"POST",
                   data:{
                       state_uid: procurement_state_uid,
                       _token:'{{ csrf_token() }}'
                   } ,
                    dataType:'json',
                    success:function(district){
                       $('#procurement_district_uid').append('<option> Select District </option>');
                       $.each(district,function(key, value){
                          $('#procurement_district_uid').append('<option value="'+ value.district_uid +'">'+ value.district_name +'</option>')
                       });
                       $('#procurement_district_uid').trigger('change');
                    }
                });

            });

            $('#procurement_state_uid').trigger('change');

            $('#procurement_district_uid').on('change',function(){
                var procurement_district_uid = this.value;
                $('#procurement_sub_district_uid').html('');
                $.ajax({
                    url:"{{ url('sub-district') }}",
                    type: "POST",
                    data:{
                        district_uid: procurement_district_uid,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result){
                        //console.log(result);
                        $("#procurement_sub_district_uid").append("<option>Select Sub-District</option>");
                        $.each(result.subDistrict, function (key,value){
                            $("#procurement_sub_district_uid").append('<option value="'+ value.sub_district_uid +'">'+ value.sub_district_name +'</option>');
                        });
                        $('#procurement_sub_district_uid').trigger('change');
                    }
                });
            });

            $("#procurement_sub_district_uid").on('change',function(){
                var procurement_sub_district_uid =this.value;
                $('#procurement_village_uid').html('');
                $.ajax({
                    url  : "{{ url('village/fetch') }}",
                    type : "POST",
                    data : {
                        sub_district_uid: procurement_sub_district_uid,
                        _token : '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result){
                        $("#procurement_village_uid").append("<option>Select Village</option>");
                        $.each(result.village,function (key,value) {
                            $("#procurement_village_uid").append('<option value="'+ value.village_uid +'">'+ value.village_name +'</option>');
                        });
                    }
                });
            });

            let warehouse_types = <?php echo json_encode($warehouse_types); ?>;
            let proCount = 0;
            $("#addNewProcurement").click(function(e) {
                $(".remove-procurement").removeClass("d-none");
                proCount++;
                let output = '';
                output = '<div class="row procurement-next-referral procurement-class"><hr class="mb-2 mt-2">';
                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="warehouse_address">Warehouse Address</label>'
                output += '<input type="text" class="form-control" name="warehouse_address[]" id="warehouse_address"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="warehouse_capacity">Warehouse Capacity</label>'
                output += '<input type="text" onkeypress="return isFloat(event);" class="form-control" name="warehouse_capacity[]" id="warehouse_capacity"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="warehouse_type_uid">Warehouse Type</label>'
                output += '<select class="form-control warehouse_type_uid select2" name="warehouse_type_uid[]" id="warehouse_type_uid'+proCount+'">'
                output += '<option value="" selected disabled> Select Warehouse Type</option>'
                $.each(warehouse_types, function (index, value) {
                    output += '<option value="'+ value.warehouse_type_uid +'" data-index="'+ index +'"> '+ value.warehouse_type_name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="procurement_state_uid">State</label>'
                output += '<select class="form-control state_uid_procurement select2" name="procurement_states[]" id="procurement_state_uid'+proCount+'">'
                output += '<option value="" selected disabled> Select State</option>'
                $.each(states, function (index, value) {
                    output += '<option value="'+ value.state_uid +'" data-index="'+ index +'"> '+ value.state_name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="procurement_district_uid">District</label>'
                output += '<select class="form-control district_uid_procurement select2" name="procurement_districts[]" id="procurement_district_uid'+proCount+'">'
                output += '<option value="" selected disabled> Select District</option>'
                $.each(districts, function (index, value) {
                    output += '<option value="'+ value.district_uid +'" data-index="'+ index +'"> '+ value.district_name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="procurement_sub_district_uid">Sub District</label>'
                output += '<select class="form-control sub_district_uid_procurement select2" name="procurement_sub_districts[]" id="procurement_sub_district_uid'+proCount+'">'
                output += '<option value="" selected disabled> Select Sub District</option>'
                $.each(sub_districts, function (index, value) {
                    output += '<option value="'+ value.sub_district_uid +'" data-index="'+ index +'"> '+ value.sub_district_name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="procurement_village_uid">Village</label>'
                output += '<select class="form-control village_uid_procurement select2" name="procurement_villages[]" id="procurement_village_uid'+proCount+'">'
                output += '<option value="" selected disabled> Select Village</option>'
                $.each(villages, function (index, value) {
                    output += '<option value="'+ value.village_uid +'" data-index="'+ index +'"> '+ value.village_name +'</option>'
                });
                output += '</select></div></div>'

                output += '</div>'


                $("#procurementDetail").append(output);
                $('#' + 'warehouse_type_uid' + proCount, '#procurementDetail').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
                $('#' + 'procurement_state_uid' + proCount, '#procurementDetail').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
                $('#' + 'procurement_district_uid' + proCount, '#procurementDetail').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
                $('#' + 'procurement_sub_district_uid' + proCount, '#procurementDetail').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
                $('#' + 'procurement_village_uid' + proCount, '#procurementDetail').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            });
            $("body").on("click", ".remove-procurement", function(e) {
                $(".procurement-next-referral").last().remove();
            });
        });
    </script>
@endsection
