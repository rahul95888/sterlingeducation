@extends('admin.layouts.master')
@section('title')
    @include('admin.news.partials.title')
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.news.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="slug">Url <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}" required>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="news_content">Content <span class="text-danger">*</span></label>
                            <textarea name="content" id="news_content" cols="30" rows="10" required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="image">Image</label>
                            <input type="file" class="form-control dropify" data-height="150" name="image" id="image"
                            data-allowed-file-extensions="png jpg jpeg webp svg">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="meta_title">Meta Title<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control" name="meta_title" required id="meta_title" value="{{ old('meta_title') }}" >
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="meta_keyword">Meta Keyword<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control" name="meta_keyword" required id="meta_keyword" value="{{ old('meta_keyword') }}" >
                            @error('meta_keyword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="meta_description">Meta Description<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control" name="meta_description" required id="meta_description" value="{{ old('meta_description') }}" >
                            @error('meta_description')
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
    <script type="text/javascript" src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            CKEDITOR.replace( 'news_content' );
            $(".dropify").dropify();
            $('.select2').select2(
                {
                    theme: 'bootstrap4',
                }
            );
        });
    </script>
@endsection
