@extends('admin.layouts.master')
@section('title')
    @include('admin.videolesson.partials.title')
@endsection
@section('styles')
<link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />

@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.videolesson.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('videolesson.update', $mocktest->id) }}" enctype="multipart/form-data" method="POST" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    @method('put')
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ $mocktest->title }}" required>  
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="slug">Slug Url <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="slug" id="slug" value="{{ $mocktest->slug }}" required>  
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10">{{ $mocktest->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror  
                        </div>
                    </div>

                    <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="address_document">Thumbnail</label>
                                    <input type="file" class="form-control dropify" data-height="150" data-default-file="{{ $mocktest->thumb != null ? '/uploads/property/'.$mocktest->thumb : null }}" data-allowed-file-extensions="png jpg jpeg webp" id="address_document" name="thumb" />
                                </div>
                            </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="url">External Url <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="url" id="url" value="{{ $mocktest->url }}" required>  
                            @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="amount">Amount <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="amount" id="amount" value="{{ $mocktest->amount }}" required>  
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="meta_title">Meta Title<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control" name="meta_title" required id="meta_title" value="{{ $mocktest->meta_title }}" >
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="meta_keyword">Meta Keyword<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control" name="meta_keyword" required id="meta_keyword" value="{{ $mocktest->meta_keyword }}" >
                            @error('meta_keyword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="meta_description">Meta Description<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control" name="meta_description" required id="meta_description" value="{{ $mocktest->meta_description }}" >
                            @error('meta_description')
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

    <script type="text/javascript" src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(".dropify").dropify();
            CKEDITOR.replace( 'description' );
        });
    </script>
@endsection