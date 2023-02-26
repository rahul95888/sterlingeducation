@extends('admin.layouts.master')
@section('title')
    @include('admin.marketings.partials.title')
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.marketings.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('marketings.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="banner_title">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control "  name="banner_title" id="banner_title" value="{{ old('banner_title') }}" required>

                            @error('banner_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="banner_description">Description <span class="text-danger">*</span></label>
                            <textarea rows="6" class="form-control "  name="banner_description" id="banner_description" required>{{ old('banner_description') }}</textarea>

                            @error('banner_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="banner_image">Banner Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control dropify" data-height="150" name="banner_image" id="banner_image"
                            data-allowed-file-extensions="png jpg jpeg webp svg">
                            @error('banner_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="banner_url">URL<span class="text-danger">*</span></label>
                            <input type="url" class="form-control "  name="banner_url" id="banner_url" value="{{ old('banner_url') }}" required>

                            @error('banner_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
        $(".dropify").dropify();
    </script>
@endsection
