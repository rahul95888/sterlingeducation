@extends('admin.layouts.master')
@section('title')
    Trade Details | Admin Panel - 
    {{ config('app.name') }} 
@endsection
@section('styles')
    
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Trades</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Trade Details</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('trades') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Trade List</a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $trade->user ? ($trade->user->name ? $trade->user->name : $trade->user->company_name) : '' }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Commodity</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $trade->commodity ? $trade->commodity->name : '' }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Variety</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $trade->variety ? $trade->variety->variety_name : '' }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" readonly>{{ $trade->description }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Quantity</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $trade->quantity }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Price</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $trade->price }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Address</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" readonly>{{ $trade->address }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Valid From</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $trade->valid_from ? $trade->valid_from->format('d/m/Y') : '' }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Valid To</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $trade->valid_to ? $trade->valid_to->format('d/m/Y') : '' }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Taluka</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $trade->taluka }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">State</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $trade->state ? $trade->state->state_name : '' }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">City</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $trade->city ? $trade->city->city_name : '' }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Pincode</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $trade->pincode ? $trade->pincode->pincode : '' }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Country</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $trade->country ? $trade->country->country_name : '' }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Quality report</label>
                            <div class="col-sm-8" style="width:200;height:150px;">
                            <?php if($trade->file != NULL){ ?>
                            <a href="<?php if($trade->file != NULL){ echo get_file_from_aws($trade->file); }?>  " target="_blank"><?php if($trade->file != NULL){ ?>  <button type="button" class="btn btn-primary btn-rounded"><i
                                                class="fa fa-times"></i> Preview</button><?php }?></a> <?php } ?>
                              </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script>
    
</script>
@endsection