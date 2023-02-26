@extends('admin.layouts.master')
@section('title')
    @include('admin.services.partials.title')
@endsection
@section('styles')

@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.services.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    @method('put')
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="service_name">Service Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="service_name" id="service_name" value="{{ $service->service_name }}" required>
                            @error('service_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="commodity_uid">Content <span class="text-danger">*</span></label>
                            <textarea name="commodity_uid" id="commodity_uid" class="form-control" cols="30" rows="10" required>{{ $service->service_name }}</textarea>
                            @error('commodity_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- <img src="{{URL::to('/uploads/property/'.$service->image)}}" style="width:50px;" /> -->
                    <!-- <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="image">Image</label>
                                    <input type="file" class="form-control dropify" data-height="150"
                                     data-allowed-file-extensions="png jpg jpeg webp" id="image" name="image"/>
                                </div>
                            </div> -->
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
<script type="text/javascript" src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function(){
            // CKEDITOR.replace( 'commodity_uid' );     
        });
    </script>
@endsection