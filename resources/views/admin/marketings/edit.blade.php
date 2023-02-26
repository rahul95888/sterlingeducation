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
                <form action="{{ route('marketings.update', $marketing->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    @method('put')
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="banner_title">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control " value="{{$marketing->banner_title}}"  name="banner_title" id="banner_title">

                            @error('banner_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="banner_description">Description <span class="text-danger">*</span></label>
                            <textarea rows="6" class="form-control " value="" name="banner_description" id="banner_description">{{$marketing->banner_description}} </textarea>

                            @error('banner_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="banner_image">Banner Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control dropify" data-height="150" id="banner_image" name="banner_image"
                            data-allowed-file-extensions="png jpg jpeg webp svg"
                            data-default-file="{{ $marketing->banner_image != null ? Storage::disk('s3')->temporaryUrl($marketing->banner_image, '+10 Minutes') : null }}"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="banner_url">URL<span class="text-danger">*</span> </label>
                            <input type="url" class="form-control " value="{{ $marketing->banner_url }}"  name="banner_url" id="banner_url">

                            @error('banner_url')
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
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script>
      $(".dropify").dropify();


    </script>
@endsection
