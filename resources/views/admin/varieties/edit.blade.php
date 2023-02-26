@extends('admin.layouts.master')
@section('title')
    @include('admin.varieties.partials.title')
@endsection
@section('styles')
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.varieties.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('varieties.update', $variety->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    @method('put')
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="variety_name">Variety Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="variety_name" id="variety_name" value="{{ $variety->variety_name }}" required>
                            @error('variety_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="commodity_uid">Commodity <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="commodity_uid" id="commodity_uid">
                                <option value="" selected> Select Commodity</option>
                                @if($commodities)
                                    @foreach($commodities as $commodity)
                                        @if($variety->commodity_uid == $commodity->commodity_uid)
                                            <option value="{{ $commodity->commodity_uid }}" selected>{{ $commodity->name }}</option>
                                        @else
                                            <option value="{{ $commodity->commodity_uid }}">{{ $commodity->name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            @error('commodity_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="from_price">From Price <span class="text-danger">*</span></label>
                            <input onkeypress="return isFloat(event);"  class="form-control" name="from_price" id="from_price" value="{{ $variety->from_price }}">
                            @error('from_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="to_price">To Price <span class="text-danger">*</span></label>
                            <input onkeypress="return isFloat(event);"  class="form-control" name="to_price" id="to_price" value="{{ $variety->to_price }}">
                            @error('to_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
    <script>
        $(document).ready(function(){
            $('.select2').select2(
                {
                    theme: 'bootstrap4',
                }
            );
        });
    </script>
@endsection
