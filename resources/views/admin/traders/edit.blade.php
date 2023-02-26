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
                <form action="{{ route('traders.update', $trader->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first"  class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    @method('put')
                    <h5 class="mb-0">Basic Details</h5>
                    <hr>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="mobile_number">Mobile Number <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" onkeypress="return /[0-9 ]/i.test(event.key)" name="mobile_number" required id="mobile_number" value="{{ $trader->mobile_number }}" readonly>
                            @error('mobile_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required id="name" value="{{ $trader->name }}" >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="company_name">Company Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="company_name" required id="company_name" value="{{ $trader->company_name }}" >
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="email">Email </label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ $trader->email }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="address">Address<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address" required id="address" value="{{ $trader->address }}" >
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="country_uid">Country <span class="text-danger">*</span></label>
                            <select class="form-control country_uid country_uid0 select2" data-country="0" name="country_uid" id="country_uid" required>
                                <option value="" disabled selected> Select Country</option>
                                @if($countries)
                                    @foreach($countries as $country)
                                        @if($trader->country_uid == $country->country_uid)
                                            <option value="{{ $country->country_uid }}" selected>{{ $country->country_name }}</option>
                                        @else
                                            <option value="{{ $country->country_uid }}">{{ $country->country_name }}</option>
                                        @endif
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
                            <label class="form-label" for="state_uid">State <span class="text-danger">*</span></label>
                            <select class="form-control state_uid state_uid0 select2" data-state="0" name="state_uid" id="state_uid" required>
                                <option value="" disabled selected> Select State</option>
                            </select>
                            @error('state_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="district_uid">District <span class="text-danger">*</span></label>
                            <select class="form-control district_uid0 district_uid select2" data-district="0" name="district_uid" id="district_uid" required>
                                <option value="" disabled selected> Select District</option>
                            </select>
                            @error('district_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="sub_district_uid">Sub District <span class="text-danger">*</span></label>
                            <select class="form-control sub_district_uid sub_district_uid0 select2" data-sub="0"  name="sub_district_uid" id="sub_district_uid" required>
                                <option value="" disabled selected> Select Sub District</option>
                            </select>
                            @error('sub_district_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="village_uid">Village <span class="text-danger">*</span></label>
                            <select class="form-control village_uid village_uid0 select2" data-village="0" name="village_uid" id="village_uid" required>
                                <option value="" disabled selected> Select Village</option>
                            </select>
                            @error('village_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="city_uid">City <span class="text-danger">*</span></label>
                            <select class="form-control city_uid city_uid0 select2" data-state="0" name="city_uid" id="city_uid" required>
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
                            <select class="form-control pincode_uid select2" name="pincode_uid" id="pincode_uid" required>
                                <option value="" disabled selected> Select Pincode</option>
                                <!-- @if($pincodes)
                                    @foreach($pincodes as $pincode)
                                        @if($trader->pincode_uid == $pincode->pincode_uid)
                                            <option value="{{ $pincode->pincode_uid }}" selected>{{ $pincode->pincode }}</option>
                                        @else
                                            <option value="{{ $pincode->pincode_uid }}">{{ $pincode->pincode }}</option>
                                        @endif
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
                    <div class="col-md-12 row">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="form-label" for="ho_location">HO Location <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="ho_location" value="{{ $trader->ho_location }}" required>
                            @error('ho_location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="form-group">
                            <label class="form-label" for="branch_locations">Branch Locations <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="branch_locations" required >
                            <option value="" selected> Select Branch Location</option>
                            @if($districts)
                                    @foreach($districts as $district)
                                        @if($trader->branch_locations == $district->district_uid)
                                                <option value="{{ $district->district_uid }}" selected> {{$district->district_name}}</option>
                                         
                                        @else
                                            <option value="{{ $district->district_uid }}"> {{$district->district_name}}</option>
                                        @endif
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
                            <label class="form-label" for="job_works">Job works</label>
                            <input type="text" class="form-control" name="job_works" value="{{ $trader->job_works }}">
                            @error('job_works')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> -->
                    <!-- <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="form-label" for="process_method_uid">Process Methods</label>
                            <select class="form-control select2" name="process_method_uid" >
                            <option value="" selected> Select Process Method</option>
                            @if($process_methods)
                                    @foreach($process_methods as $process_method)
                                        @if($trader->process_method_uid == $process_method->process_method_uid)
                                                <option value="{{ $process_method->process_method_uid }}" selected> {{$process_method->process_method_name}}</option>
                                        
                                        @else
                                            <option value="{{ $process_method->process_method_uid }}"> {{$process_method->process_method_name}}</option>
                                        @endif
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
                            <label class="form-label" for="mandi_registration_details">Mandi Registration Details <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="mandi_registration_details" value="{{ $trader->mandi_registration_details }}" required>
                            @error('mandi_registration_details')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                        </div>
                    <h5 class="mb-0">Crop Details</h5>
                        
                    <div class="col-md-12" id="cropPattern">
                        @if($trader->userCropDetails)
                                @php
                                    $crop_count = count($trader->userCropDetails);
                                @endphp
                                @foreach($trader->userCropDetails as $cropKey => $crop_pattern)

                                    <div class="row crop-class @if($cropKey != 0) next-referral @endif" >
                                        <hr class="mb-2 mt-2">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label" for="commodity_uid">Commodity <span class="text-danger">*</span></label>
                                                <select class="form-control commodity_uid select2" name="commodity_uid[]" required>
                                                    <option value="" selected> Select Commodity</option>
                                                    @if($commodities)
                                                        @foreach($commodities as $key =>  $commodity)
                                                            @if($crop_pattern->commodity_uid == $commodity->commodity_uid)
                                                                <option value="{{ $commodity->commodity_uid }}" data-index="{{ $key }}" data-commodity = "{{ $crop_pattern->commodity_uid }}"  data-variety = "{{ $crop_pattern->variety_uid }}" selected> {{$commodity->name}}</option>
                                                            @else
                                                                <option value="{{ $commodity->commodity_uid }}" data-index="{{ $key }}"> {{$commodity->name}}</option>
                                                            @endif
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
                                                <label class="form-label" for="variety_uid">Variety<span class="text-danger">*</span></label>
                                                <select class="form-control variety_uid select2" name="variety_uid[]" required>
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
                                                <select class="form-control  select2" name="form_factor[]" required>
                                                    <option value="" > Select Form Factor</option>
                                                    @if($formfactor)
                                                    @foreach($formfactor as $val)
                                                    @if($crop_pattern->form_factor == $val->farm_factor_uid)
                                                    <option value="{{ $val->farm_factor_uid }}" selected> {{$val->farm_factor_name}}</option>
                                                            @else
                                                            <option value="{{ $val->farm_factor_uid }}"> {{$val->farm_factor_name}}</option>
                                                            @endif
                                                        
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
                                                <input type="text" class="form-control tonnage_daily" name="tonnage_daily[]" onkeypress="return isFloat(event);" required value="{{ $crop_pattern->tonnage_daily }}">
                                                @error('tonnage_daily')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="tonnage_monthly">Tonnage Monthly <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="tonnage_monthly[]" onkeypress="return isFloat(event);" value="{{ $crop_pattern->tonnage_monthly }}" required>
                                                @error('tonnage_monthly')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="tonnage_yearly">Tonnage Yearly <span class="text-danger">*</span></label>
                                                <input type="text" onkeypress="return isFloat(event);" class="form-control" name="tonnage_yearly[]"  value="{{ $crop_pattern->tonnage_yearly }}" required>
                                                @error('tonnage_yearly')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="crop_state_uid">State <span class="text-danger">*</span></label>
                                                <select class="form-control select2" name="states[]" id="crop_state_uid" required>
                                                    <option value="" selected> Select State</option>
                                                    @if($states)
                                                        @foreach($states as $state)
                                                            @if($crop_pattern->state_uid == $state->state_uid)
                                                                <option value="{{ $state->state_uid }}" selected> {{$state->state_name}}</option>
                                                            @else
                                                                <option value="{{ $state->state_uid }}"> {{$state->state_name}}</option>
                                                            @endif
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
                                                <select class="form-control  select2" name="districts[]" id="crop_district_uid" required>
                                                    <option value="" selected> Select District</option>
                                                    @if($districts)
                                                        @foreach($districts as $district)
                                                            @if($crop_pattern->district_uid == $district->district_uid)
                                                                <option value="{{ $district->district_uid }}" selected> {{$district->district_name}}</option>
                                                            @else
                                                                <option value="{{ $district->district_uid }}"> {{$district->district_name}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('district_uid')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="sub_district_uid">Sub District <span class="text-danger">*</span></label>
                                                <select class="form-control  select2" name="sub_districts[]" id="crop_sub_district_uid" required>
                                                    <option value="" selected> Select Sub District</option>
                                                    @if($sub_districts)
                                                        @foreach($sub_districts as $sub_district)
                                                            @if($crop_pattern->sub_district_uid == $sub_district->sub_district_uid)
                                                                <option value="{{ $sub_district->sub_district_uid }}" selected> {{$sub_district->sub_district_name}}</option>
                                                            @else
                                                                <option value="{{ $sub_district->sub_district_uid }}"> {{$sub_district->sub_district_name}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('sub_district_uid')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="village_uid">Village <span class="text-danger">*</span></label>
                                                <select class="form-control  select2" name="villages[]" id="crop_village_uid" required>
                                                    <option value="" selected> Select Village</option>
                                                    @if($villages)
                                                        @foreach($villages as $village)
                                                            @if($crop_pattern->village_uid == $village->village_uid)
                                                                <option value="{{ $village->village_uid }}" selected> {{$village->village_name}}</option>
                                                            @else
                                                                <option value="{{ $village->village_uid }}"> {{$village->village_name}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('village_uid')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="process_method_uid">Process Methods <span class="text-danger">*</span></label>
                                                <select class="form-control select2" name="process_method_uid[]" required>
                                                <option value="" selected> Select Process Method</option>
                                                @if($process_methods)
                                                        @foreach($process_methods as $process_method)
                                                            @if($crop_pattern->process_method_uid == $process_method->process_method_uid)
                                                                <option value="{{ $process_method->process_method_uid }}" selected> {{$process_method->process_method_name}}</option>
                                                            @else
                                                                <option value="{{ $process_method->process_method_uid }}"> {{$process_method->process_method_name}}</option>
                                                            @endif
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
                                                <select class="form-control select2" name="process_capability_uid[]">
                                                    @if($process_capability)
                                                        @foreach($process_capability as $capability)
                                                            @if($crop_pattern->process_capability_uid)
                                                                <option value="{{ $capability->process_capability_uid }}" selected> {{$capability->process_capability_name}}</option>
                                                            @else
                                                                <option value="{{ $capability->process_capability_uid }}"> {{$capability->process_capability_name}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('process_capability_uid')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div> -->
                                    </div>
                                @endforeach
                            @else
                            <div class="row crop-class" >
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label" for="commodity_uid">Commodity <span class="text-danger">*</span></label>
                                        <select class="form-control commodity_uid  select2" required name="commodity_uid[]">
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
                                        <select class="form-control variety_uid  select2" name="variety_uid[]" required>
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
                                        <select class="form-control  select2" name="form_factor[]" required>
                                            <option value="" selected> Select Form Factor</option>
                                            @if($formfactor)
                                                    @foreach($formfactor as $val)
                                                    @if($crop_pattern->form_factor == $val->farm_factor_uid)
                                                    <option value="{{ $val->farm_factor_uid }}" selected> {{$val->farm_factor_name}}</option>
                                                            @else
                                                            <option value="{{ $val->farm_factor_uid }}"> {{$val->farm_factor_name}}</option>
                                                            @endif
                                                        
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
                                        <input type="text" class="form-control" name="tonnage_daily[]" onkeypress="return isFloat(event);" required>
                                        @error('tonnage_daily')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="tonnage_monthly">Tonnage Monthly <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="tonnage_monthly[]" onkeypress="return isFloat(event);" required step="any">
                                        @error('tonnage_monthly')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="tonnage_yearly">Tonnage Yearly <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="tonnage_yearly[]" onkeypress="return isFloat(event);" required step="any">
                                        @error('tonnage_yearly')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="state_uid">State <span class="text-danger">*</span></label>
                                        <select class="form-control state_uid state_uid1 select2" data-state="1" name="states[]" id="crop_state_uid" required>
                                            <option value="" selected> Select State</option>
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
                                        <select class="form-control district_uid district_uid1 select2" data-district="1" name="districts[]" id="crop_district_uid" required>
                                            <option value="" selected> Select District</option>

                                        </select>
                                        @error('district_uid')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="sub_district_uid">Sub District <span class="text-danger">*</span></label>
                                        <select class="form-control sub_district_uid sub_district_uid1 select2" data-sub="1" name="sub_districts[]" id="crop_sub_district_uid" required>
                                            <option value="" selected> Select Sub District</option>
                                            @if($sub_districts)
                                                @foreach($sub_districts as $sub_district)
                                                    <option value="{{ $sub_district->sub_district_uid }}" @if(old('sub_district_uid') == $sub_district->sub_district_uid) selected @endif> {{$sub_district->sub_district_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('sub_district_uid')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="village_uid">Village <span class="text-danger">*</span></label>
                                        <select class="form-control village_uid village_uid1  select2" data-village="1" name="villages[]" id="crop_village_uid" required>
                                            <option value="" selected> Select Village</option>
                                            @if($villages)
                                                @foreach($villages as $village)
                                                    <option value="{{ $village->village_uid }}" @if(old('village_uid') == $village->village_uid) selected @endif> {{$village->village_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('village_uid')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="ho_location">HO Location <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="ho_location[]" required>
                                        @error('ho_location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="branch_locations">Branch Locations <span class="text-danger">*</span></label>
                                        <select class="form-control select2" name="branch_locations[]" required>
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
                                <!-- <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="process_method_uid">Process Methods</label>
                                        <select class="form-control select2" name="process_method_uid[]" multiple>
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
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="mandi_registration_details">Mandi Registration Details <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mandi_registration_details[]" required>
                                        @error('mandi_registration_details')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-12 text-end">
                        <button type="button" class="btn btn-primary px-5" id="addNewCrop"><i class="bx bx-plus"></i>Add</button>
                        <button type="button" class="btn btn-primary px-5 remove-crop @if(isset($crop_count) && $crop_count == 1)d-none @endif" id="removeCrop"><i class="bx bx-minus"></i>Remove</button>
                    </div>
                    <h5 class="mb-0">Procurement Details</h5>
                    <span class="text-info">( All the fields are mandatory if one input present )</span>
                    <hr>
                    <div class="col-md-12" id="procurementDetail">
                        @if($trader->userProcurements)
                                @php
                                    $procurement_count = count($trader->userProcurements);
                                @endphp
                                @foreach($trader->userProcurements as $procurementKey => $procurement)

                                    <div class="row procurement-class @if($procurementKey != 0) procurement-next-referral @endif" >
                                        <hr class="mb-2 mt-2">
                                        <div class="col-md-2 mb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="warehouse_address">Warehouse Address</label>
                                                <input type="text" class="form-control" name="warehouse_address[]" id="warehouse_address" value="{{ $procurement->warehouse_address }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="warehouse_capacity">Warehouse Capacity</label>
                                                <input type="text" onkeypress="return isFloat(event);" class="form-control" name="warehouse_capacity[]" id="warehouse_capacity" value="{{ $procurement->warehouse_capacity }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="warehouse_type_uid">Warehouse Type</label>
                                                <select class="form-control select2" name="warehouse_type_uid[]" id="warehouse_type_uid">
                                                    <option value="" disabled selected> Select Warehouse Type</option>
                                                    @if($warehouse_types)
                                                        @foreach($warehouse_types as $warehouse_type)
                                                            @if($procurement->warehouse_type_uid == $warehouse_type->warehouse_type_uid)
                                                                <option value="{{ $warehouse_type->warehouse_type_uid }}" selected> {{$warehouse_type->warehouse_type_name}}</option>
                                                            @else
                                                                <option value="{{ $warehouse_type->warehouse_type_uid }}"> {{$warehouse_type->warehouse_type_name}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="procurement_state_uid">State</label>
                                                <select class="form-control select2" name="procurement_states[]" id="procurement_state_uid">
                                                    <option value="" selected disabled> Select State</option>
                                                    @if($states)
                                                        @foreach($states as $state)
                                                            @if($procurement->state_uid == $state->state_uid)
                                                                <option value="{{ $state->state_uid }}" selected> {{$state->state_name}}</option>
                                                            @else
                                                                <option value="{{ $state->state_uid }}"> {{$state->state_name}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="procurement_district_uid">Distric</label>
                                                <select class="form-control select2" name="procurement_districts[]" id="procurement_district_uid">
                                                    <option value="" selected> Select District</option>
                                                    @if($traderdistricts)
                                                        @foreach($traderdistricts as $district)
                                                            @if($procurement->district_uid == $district->district_uid)
                                                                <option value="{{ $district->district_uid }}" selected> {{$district->district_name}}</option>
                                                            @else
                                                                <option value="{{ $district->district_uid }}"> {{$district->district_name}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('district_uid')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="procurement_sub_district_uid">Sub Distric</label>
                                                <select class="form-control  select2" name="procurement_sub_districts[]" id="procurement_sub_district_uid">
                                                    <option value="" selected> Select Sub District</option>
                                                    @if($tradersub_districts)
                                                        @foreach($tradersub_districts as $sub_district)
                                                            @if($procurement->sub_district_uid == $sub_district->sub_district_uid)
                                                                <option value="{{ $sub_district->sub_district_uid }}" selected> {{$sub_district->sub_district_name}}</option>
                                                            @else
                                                                <option value="{{ $sub_district->sub_district_uid }}"> {{$sub_district->sub_district_name}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('sub_district_uid')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <div class="form-group">
                                                <label class="form-label" for="procurement_village_uid">Villag</label>
                                                <select class="form-control  select2" name="procurement_villages[]" id="procurement_village_uid">
                                                    <option value="" selected> Select Village</option>
                                                    @if($tradervillages)
                                                        @foreach($tradervillages as $village)
                                                            @if($procurement->village_uid == $village->village_uid)
                                                                <option value="{{ $village->village_uid }}" selected> {{$village->village_name}}</option>
                                                            @else
                                                                <option value="{{ $village->village_uid }}"> {{$village->village_name}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('village_uid')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
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
                        @endif
                    </div>
                    <div class="col-md-12 text-end">
                        <button type="button" class="btn btn-primary px-5" id="addNewProcurement"><i class="bx bx-plus"></i>Add</button>
                        <button type="button" class="btn btn-primary px-5 remove-procurement @if(isset($procurement_count) && $procurement_count == 1)d-none @endif" id="removeProcurement"><i class="bx bx-minus"></i>Remove</button>
                    </div>
                    <h5 class="mb-0">Documents</h5>
                    <hr>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="gst_number">GST Number</label>
                                    <input type="text"   maxlength="15"  onkeypress="return /[A-Za-z 0-9]/i.test(event.key)" class="form-control" name="gst_number" id="gst_number" value="{{ $trader->gst_number }}">
                                    @error('gst_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="gst_document">GST Document</label>
                                    <input type="file" class="form-control dropify" data-height="150" data-allowed-file-extensions="png jpg jpeg webp" id="gst_document" name="gst_document"
                                    data-default-file="{{ $trader->gst_document != null ? Storage::disk('s3')->temporaryUrl($trader->gst_document, '+10 minutes') : null }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="account_number">Account Number</label>
                                    <input type="text"  maxlength="12"  onkeypress="return /[0-9 ]/i.test(event.key)" class="form-control" name="account_number" id="account_number" value="{{ $trader->account_number }}">
                                    @error('account_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="account_holder_name">Account Holder Name</label>
                                    <input type="text" class="form-control" name="account_holder_name" id="account_holder_name" value="{{ $trader->account_holder_name }}">
                                    @error('account_holder_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="ifsc_code">IFSC Code</label>
                                    <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" value="{{ $trader->ifsc_code }}">
                                    <p style="display:none;color:red;" id="ifsc_error">Please enter a valid IFSC Code</p>
                                    @error('ifsc_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="bank_name">Bank Name</label>
                                    <input type="text" class="form-control" name="bank_name" id="bank_name" value="{{ $trader->bank_name }}" readonly>
                                    @error('bank_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="branch_name">Branch Name</label>
                                    <input type="text" class="form-control" name="branch_name" id="branch_name" value="{{ $trader->branch_name }}" readonly>
                                    @error('branch_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="bank_document">Bank Document</label>
                                    <input type="file" class="form-control dropify" data-height="150" data-allowed-file-extensions="png jpg jpeg webp" id="bank_document" name="bank_document"
                                    data-default-file="{{ $trader->bank_document != null ? Storage::disk('s3')->temporaryUrl($trader->bank_document, '+10 minutes') : null }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="address_document_type">Address Document Type</label>
                                    <select class="form-control" name="address_document_type" id="address_document_type" >
                                        <option value="" selected> Select Address Document Type</option>
                                        <option value="electricity" @if($trader->address_document_type == 'electricity') selected @endif> Electricity Document</option>
                                        <option value="gas" @if($trader->address_document_type == 'gas') selected @endif> Gas Bill</option>
                                        <option value="internet" @if($trader->address_document_type == 'internet') selected @endif> Internet Bill</option>
                                    </select>
                                    @error('address_document_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="address_document_id_number">ID Number</label>
                                    <input type="text" class="form-control" name="address_document_id_number" id="address_document_id_number" value="{{ $trader->address_document_id_number }}">
                                    @error('address_document_id_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="address_document">Address Document</label>
                                    <input type="file" class="form-control dropify" data-height="150" data-allowed-file-extensions="png jpg jpeg webp" id="address_document" name="address_document"
                                    data-default-file="{{ $trader->address_document != null ? Storage::disk('s3')->temporaryUrl($trader->address_document, '+10 minutes') : null }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-5">Update</button>
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
        $(document).ready(function(){
            $(".dropify").dropify();
            $('.select2').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
            let commodities = <?php echo json_encode($commodities); ?>;
            let formfactor = <?php echo json_encode($formfactor); ?>;
            let states = <?php echo json_encode($states); ?>;
            let districts = <?php echo json_encode($districts); ?>;
            let sub_districts = <?php echo json_encode($sub_districts); ?>;
            let villages = <?php echo json_encode($villages); ?>;
            let process_methods = <?php echo json_encode($process_methods); ?>;
           // let process_capability = <?php echo json_encode($process_capability); ?>;

            $(document).on('change','.commodity_uid',function () {
                let parent_id = $(this).val();
                if ($(this).val() != '' && $(this).val() != 'Select Commodity') {
                    let index = $(this).find(':selected').data('index');
                    let commodity = $(this).find(':selected').data('commodity');
                    let variety = $(this).find(':selected').data('variety');
                    let varieties = commodities[index].varieties;
                    let output = '<option value="">Select Variety</option>'
                    $.each(varieties, function (index, value) {
                        if((parent_id == commodity) && (variety == value.variety_uid)){
                            output +='<option value="' + value.variety_uid + '" selected>' + value.variety_name + '</option>'
                        }else{
                            output +='<option value="' + value.variety_uid + '">' + value.variety_name + '</option>'
                        }

                    });
                    $(this).closest('.crop-class').find('.variety_uid').html(output);
                }
            });

            $('.commodity_uid').trigger('change');
            let count = 1;
            $("#addNewCrop").click(function(e) {
                $(".remove-crop").removeClass("d-none");
                count++;

                let output = '';
                output = '<div class="row next-referral crop-class"><hr class="mb-2 mt-2">';
                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="commodity_uid">Commodity <span class="text-danger">*</span></label>'
                output += '<select class="form-control commodity_uid" name="commodity_uid[]" id="commodity_uid'+count+'" required>'
                output += '<option value="" selected> Select Commodity</option>'
                $.each(commodities, function (index, value) {
                    output += '<option value="'+ value.commodity_uid +'" data-index="'+ index +'"> '+ value.name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="variety_uid">Variety <span class="text-danger">*</span></label>'
                output += '<select class="form-control variety_uid" name="variety_uid[]" id="variety_uid'+count+'" required>'
                output += '<option value="" selected> Select Variety</option>'
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="form_factor">Form Factor</label>'
                output += '<select class="form-control form_factor select2" name="form_factor[]" id="form_factor'+count+'">'
                output += '<option value="" selected> Select Form Factor</option>'
                $.each(formfactor, function (index, value) {
                    output += '<option value="'+ value.farm_factor_uid +'" data-index="'+ index +'"> '+ value.farm_factor_name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label tonnage_daily" for="tonnage_daily">Tonnage Daily <span class="text-danger">*</span></label>'
                output += '<input type="text" class="form-control" name="tonnage_daily[]" id="tonnage_daily" onkeypress="return isFloat(event);" > '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="tonnage_monthly">Tonnage Monthly</label>'
                output += '<input type="text" class="form-control" name="tonnage_monthly[]" id="tonnage_monthly" onkeypress="return isFloat(event);"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="tonnage_yearly">Tonnage Yearly</label>'
                output += '<input type="text" class="form-control" name="tonnage_yearly[]" id="tonnage_yearly" onkeypress="return isFloat(event);"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="state_uid">State</label>'
                output += '<select class="form-control state_uid state_uid'+count+' select2" name="states[]" data-state="'+count+'" id="state_uid'+count+'">'
                output += '<option value="" selected> Select State</option>'
                $.each(states, function (index, value) {
                    output += '<option value="'+ value.state_uid +'" data-index="'+ index +'"> '+ value.state_name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="district_uid">District</label>'
                output += '<select class="form-control district_uid district_uid'+count+' select2" data-district="'+count+'" name="districts[]" id="district_uid'+count+'">'
                output += '<option value="" selected> Select District</option>'
                $.each(districts, function (index, value) {
                    output += '<option value="'+ value.district_uid +'" data-index="'+ index +'"> '+ value.district_name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="sub_district_uid">Sub District</label>'
                output += '<select class="form-control sub_district_uid sub_district_uid'+count+' select2" data-sub="'+count+'" name="sub_districts[]" id="sub_district_uid'+count+'">'
                output += '<option value="" selected> Select Sub District</option>'
                $.each(sub_districts, function (index, value) {
                    output += '<option value="'+ value.sub_district_uid +'" data-index="'+ index +'"> '+ value.sub_district_name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="village_uid">Village</label>'
                output += '<select class="form-control village_uid village_uid'+count+' data-village="'+count+'" select2" name="villages[]" id="village_uid'+count+'">'
                output += '<option value="" selected> Select Village</option>'
                $.each(villages, function (index, value) {
                    output += '<option value="'+ value.village_uid +'" data-index="'+ index +'"> '+ value.village_name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="process_method_uid">Process Methods</label>'
                output += '<select class="form-control process_method_uid select2" name="process_method_uid[]"  id="process_method_uid'+count+'"><option value="" selected> Select Process Method</option>'
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

            var state_uid = '{{ $trader->state_uid }}';
            var district_uid = '{{ $trader->district_uid }}';
            var city_uid = '{{ $trader->city_uid }}';
            var sub_district_uid = '{{ $trader->sub_district_uid }}';
            var village_uid = '{{ $trader->village_uid }}';
            var pincode_uid = '{{ $trader->pincode_uid }}';

            $('#country_uid').on('change',function(){
                $('#state_uid').html('');
                $('#city_uid').html('');
               $('#district_uid').html('');
               $('#sub_district_uid').html('');
               $('#village_uid').html('');  
               $('#pincode_uid').html(''); 
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

                        $("#state_uid").append('<option>Select State</option>');
                        $.each(states,function (key ,value){
                            if(state_uid === value.state_uid){
                                $('#state_uid').append('<option value="'+value.state_uid +'" selected>'+ value.state_name +'</option>');
                            }else{
                                $('#state_uid').append('<option value="'+value.state_uid +'">'+ value.state_name +'</option>');
                            }
                        });
                        $('#state_uid').trigger('change');
                    }
                });

            });

            $('#country_uid').trigger('change');

            $('#state_uid').on('change',function(){
                $('#district_uid').html('');
                $('#city_uid').html('');
               $('#sub_district_uid').html('');
               $('#village_uid').html(''); 
               $('#pincode_uid').html('');
                var state_uid= this.value;
                $.ajax({
                    url: "{{ url('district/fetch') }}",
                    type:"POST",
                    data:{
                        state_uid: state_uid,
                        _token:'{{ csrf_token() }}'
                    } ,
                    dataType:'json',
                    success:function(district){
                        $('#district_uid').append('<option> Select District </option>');
                        $.each(district,function(key, value){
                            if(value.district_uid === district_uid){
                                $('#district_uid').append('<option value="'+ value.district_uid +'" selected>'+ value.district_name +'</option>')
                            }else{
                                $('#district_uid').append('<option value="'+ value.district_uid +'">'+ value.district_name +'</option>')
                            }
                        });
                        $('#district_uid').trigger('change');
                    }
                });
                $.ajax({
                    url: "{{ url('cities/fetch') }}",
                    type:"POST",
                    data:{
                        state_uid: state_uid,
                        _token:'{{ csrf_token() }}'
                    } ,
                    dataType:'json',
                    success:function(city){
                        console.log(city)
                        $('#city_uid').append('<option> Select City </option>');
                        $.each(city,function(key, value){
                            if(value.city_uid === city_uid){
                                $('#city_uid').append('<option value="'+ value.city_uid +'" selected>'+ value.city_name +'</option>')
                            }else{
                                $('#city_uid').append('<option value="'+ value.city_uid +'">'+ value.city_name +'</option>')
                            }
                        });
                        $('#city_uid').trigger('change');
                    }
                });
            });
            $('#city_uid').on('change',function(){
                
                var city_uid = this.value;
                $('#pincode_uid').html('');
                $.ajax({
                    url:"{{ url('pincodes/fetch') }}",
                    type: "POST",
                    data:{
                        city_uid: city_uid,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result){
                        $("#pincode_uid").append("<option>Select Pincode</option>");
                        console.log(result);
                        $.each(result, function (key,value){
                            if(value.pincode_uid == pincode_uid){
                                $("#pincode_uid").append('<option value="'+ value.pincode_uid +'" selected>'+ value.pincode +'</option>');
                            }else{
                                $("#pincode_uid").append('<option value="'+ value.pincode_uid +'">'+ value.pincode +'</option>');
                            }
                        });
                        $('#pincode_uid').trigger('change');
                    }
                });
            });
            $('#district_uid').on('change',function(){
                
                var district_uid = this.value;
                $('#sub_district_uid').html('');
               $('#village_uid').html('');  
                $.ajax({
                    url:"{{ url('sub-district') }}",
                    type: "POST",
                    data:{
                        district_uid: district_uid,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result){
                        $("#sub_district_uid").append("<option>Select Sub-District</option>");
                        $.each(result.subDistrict, function (key,value){
                            if(value.sub_district_uid == sub_district_uid){
                                $("#sub_district_uid").append('<option value="'+ value.sub_district_uid +'" selected>'+ value.sub_district_name +'</option>');
                            }else{
                                $("#sub_district_uid").append('<option value="'+ value.sub_district_uid +'">'+ value.sub_district_name +'</option>');
                            }
                        });
                        $('#sub_district_uid').trigger('change');
                    }
                });
            });


            $("#sub_district_uid").on('change',function(){
                var sub_district_uid =this.value;
                $('#village_uid').html('');
                $.ajax({
                    url  : "{{ url('village/fetch') }}",
                    type : "POST",
                    data : {
                        sub_district_uid: sub_district_uid,
                        _token : '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result){
                        $("#village_uid").append("<option>Select Village</option>");
                        $.each(result.village,function (key,value) {
                            if(value.village_uid == village_uid){
                                $("#village_uid").append('<option value="'+ value.village_uid +'" selected>'+ value.village_name +'</option>');
                            }else{
                                $("#village_uid").append('<option value="'+ value.village_uid +'">'+ value.village_name +'</option>');
                            }
                        });
                    }
                });
            });

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

            $('#crop_state_uid').on('change',function(){
                $('#crop_district_uid').html('');
                let crop_state_uid= this.value;
                $.ajax({
                   url: "{{ url('district/fetch') }}",
                   type:"POST",
                   data:{
                       state_uid: crop_state_uid,
                       _token:'{{ csrf_token() }}'
                   } ,
                    dataType:'json',
                    success:function(district){
                       $('#crop_district_uid').append('<option> Select District </option>');
                       $.each(district,function(key, value){
                          $('#crop_district_uid').append('<option value="'+ value.district_uid +'">'+ value.district_name +'</option>')
                       });
                       $('#crop_district_uid').trigger('change');
                    }
                });

            });

            $('#crop_district_uid').on('change',function(){
                var crop_district_uid = this.value;
                $('#crop_sub_district_uid').html('');
                $.ajax({
                    url:"{{ url('sub-district') }}",
                    type: "POST",
                    data:{
                        district_uid: crop_district_uid,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result){
                        //console.log(result);
                        $("#crop_sub_district_uid").append("<option>Select Sub-District</option>");
                        $.each(result.subDistrict, function (key,value){
                            $("#crop_sub_district_uid").append('<option value="'+ value.sub_district_uid +'">'+ value.sub_district_name +'</option>');
                        });
                        $('#crop_sub_district_uid').trigger('change');
                    }
                });
            });

            $("#crop_sub_district_uid").on('change',function(){
                var crop_sub_district_uid =this.value;
                $('#crop_village_uid').html('');
                $.ajax({
                    url  : "{{ url('village/fetch') }}",
                    type : "POST",
                    data : {
                        sub_district_uid: crop_sub_district_uid,
                        _token : '{{ csrf_token() }}'
                    },
                    dataType:'json',
                    success:function(result){
                        $("#crop_village_uid").append("<option>Select Village</option>");
                        $.each(result.village,function (key,value) {
                            $("#crop_village_uid").append('<option value="'+ value.village_uid +'">'+ value.village_name +'</option>');
                        });
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
            let cropCount = 0;
            $("#addNewProcurement").click(function(e) {
                $(".remove-procurement").removeClass("d-none");
                cropCount++;
                let output = '';
                output = '<div class="row procurement-next-referral procurement-class"><hr class="mb-2 mt-2">';
                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="warehouse_address">Warehouse Address</label>'
                output += '<input type="text" class="form-control" name="warehouse_address[]" id="warehouse_address"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="warehouse_capacity">Warehouse Capacity</label>'
                output += '<input type="text" onkeypress="return isFloat(event);" class="form-control" name="warehouse_capacity[]" id="warehouse_capacity"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="warehouse_type_uid">Warehouse Type</label>'
                output += '<select class="form-control warehouse_type_uid select2" name="warehouse_type_uid[]" id="warehouse_type_uid'+cropCount+'">'
                output += '<option value="" selected disabled> Select Warehouse Type</option>'
                $.each(warehouse_types, function (index, value) {
                    output += '<option value="'+ value.warehouse_type_uid +'" data-index="'+ index +'"> '+ value.warehouse_type_name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="procurement_state_uid">State</label>'
                output += '<select class="form-control state_uid_procurement select2" name="procurement_states[]" id="procurement_state_uid'+cropCount+'">'
                output += '<option value="" selected disabled> Select State</option>'
                $.each(states, function (index, value) {
                    output += '<option value="'+ value.state_uid +'" data-index="'+ index +'"> '+ value.state_name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="procurement_district_uid">District</label>'
                output += '<select class="form-control district_uid_procurement select2" name="procurement_districts[]" id="procurement_district_uid'+cropCount+'">'
                output += '<option value="" selected disabled> Select District</option>'
                $.each(districts, function (index, value) {
                    output += '<option value="'+ value.district_uid +'" data-index="'+ index +'"> '+ value.district_name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="procurement_sub_district_uid">Sub District</label>'
                output += '<select class="form-control sub_district_uid_procurement select2" name="procurement_sub_districts[]" id="procurement_sub_district_uid'+cropCount+'">'
                output += '<option value="" selected disabled> Select Sub District</option>'
                $.each(sub_districts, function (index, value) {
                    output += '<option value="'+ value.sub_district_uid +'" data-index="'+ index +'"> '+ value.sub_district_name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="procurement_village_uid">Village</label>'
                output += '<select class="form-control village_uid_procurement select2" name="procurement_villages[]" id="procurement_village_uid'+cropCount+'">'
                output += '<option value="" selected disabled> Select Village</option>'
                $.each(villages, function (index, value) {
                    output += '<option value="'+ value.village_uid +'" data-index="'+ index +'"> '+ value.village_name +'</option>'
                });
                output += '</select></div></div>'

                output += '</div>'


                $("#procurementDetail").append(output);
                $('#' + 'warehouse_type_uid' + cropCount, '#procurementDetail').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
                $('#' + 'procurement_state_uid' + cropCount, '#procurementDetail').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
                $('#' + 'procurement_district_uid' + cropCount, '#procurementDetail').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
                $('#' + 'procurement_sub_district_uid' + cropCount, '#procurementDetail').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
                $('#' + 'procurement_village_uid' + cropCount, '#procurementDetail').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            });
            $("body").on("click", ".remove-procurement", function(e) {
                $(".procurement-next-referral").last().remove();
            });
        })
    </script>
@endsection
